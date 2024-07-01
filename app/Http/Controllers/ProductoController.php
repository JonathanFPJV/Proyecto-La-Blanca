<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Almacen;
use App\Models\Logistica;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\PriceTree;


class ProductoController extends Controller
{
    public function inicio()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        $recomendaciones = Producto::inRandomOrder()->take(4)->get(); // Productos recomendados de manera aleatoria
        return view('home', compact('productos', 'categorias', 'recomendaciones'));
    }

    public function index()
    {
        $productos = Producto::with(['logistica.almacen', 'categoria'])->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function filtrarPorPrecio(Request $request)
    {
        $categoria = $request->input('categoria');
        $minPrecio = $request->input('min', 0);
        $maxPrecio = $request->input('max', 1000);

        // Obtener los productos de la categoría seleccionada
        $productos = Producto::whereHas('categoria', function ($query) use ($categoria) {
            $query->where('nombre_categoria', $categoria);
        })->get();

        // Crear un nuevo árbol binario y llenar con los productos filtrados por categoría
        $tree = new PriceTree();

        foreach ($productos as $producto) {
            $tree->insert($producto);
        }

        // Filtrar los productos utilizando el árbol binario
        $filteredProducts = $tree->findInRange($minPrecio, $maxPrecio);

        // Retornar la vista con los productos filtrados
        return view('productos.index', compact('filteredProducts', 'categoria'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        $recomendaciones = Producto::inRandomOrder()->take(4)->get(); // Número de productos que saldrá en las recomendaciones
    
        // Obtener el historial de productos vistos por el usuario desde la sesión
        $historial = session()->get('historial_productos', []);
    
        // Agregar el producto actual al inicio del historial (LIFO)
        array_unshift($historial, $producto->Id_Producto);
    
        // Limitar el historial a los últimos 5 productos
        $historial = array_slice($historial, 0, 5);
    
        // Guardar el historial en la sesión
        session()->put('historial_productos', $historial);
    
        // Obtener los detalles de los productos en el historial
        $productos_historial = Producto::whereIn('Id_Producto', $historial)->get();
    
        // Obtener el stock desde la tabla logisticas
        $logistica = Logistica::where('Id_Producto', $id)->first();
        $stock = $logistica ? $logistica->stock : 'Sin stock disponible';
    
        return view('producto', compact('producto', 'recomendaciones', 'productos_historial', 'stock'));
    }
    

    public function polos()
    {
        $categoria = Categoria::where('nombre_categoria', 'polos')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.polos', compact('productos'));
    }

    public function pantalones()
    {
        $categoria = Categoria::where('nombre_categoria', 'pantalones')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.pantalones', compact('productos'));
    }

    public function gorras()
    {
        $categoria = Categoria::where('nombre_categoria', 'gorras')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.gorras', compact('productos'));
    }

    public function poleras()
    {
        $categoria = Categoria::where('nombre_categoria', 'poleras')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.poleras', compact('productos'));
    }

    public function zapatillas()
    {
        $categoria = Categoria::where('nombre_categoria', 'zapatillas')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.zapatillas', compact('productos'));
    }

    public function medias()
    {
        $categoria = Categoria::where('nombre_categoria', 'medias')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.medias', compact('productos'));
    }

    public function adminIndex()
    {
        $productos = Producto::all();
        return view('admin.productos', compact('productos'));
    }

    public function create()
    {
        $almacenes = Almacen::all();
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('almacenes', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Codigo_producto' => 'required|string|max:255',
            'Nombre_producto' => 'required|string|max:255',
            'Descripcion' => 'required|string',
            'Precio' => 'required|numeric',
            'id_categoria' => 'required|integer|exists:categorias,id',
            'Talla' => 'required|string|max:255',
            'Color' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ], [

            'Codigo_producto.unique' => 'El código del producto ya existe.',
        ]);

        // Verificar si el código del producto ya existe
        if (Producto::where('Codigo_producto', $request->Codigo_producto)->exists()) {
            return redirect()->back()->withErrors(['Codigo_producto' => 'El código del producto ya existe.'])->withInput();
        }

        // Validar datos adicionales si se seleccionó la opción de añadir stock y almacén
        if ($request->has('add_stock')) {
            $request->validate([
                'almacen_id' => 'required|integer|exists:almacenes,Id_Almacen',
                'stock' => 'required|integer',
            ]);
        }

        $folder = 'productos/' . $request->Codigo_producto;

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store($folder, 'public');
        }
        if ($request->hasFile('image_1')) {
            $data['image_1'] = $request->file('image_1')->store($folder, 'public');
        }
        if ($request->hasFile('image_2')) {
            $data['image_2'] = $request->file('image_2')->store($folder, 'public');
        }
        if ($request->hasFile('image_3')) {
            $data['image_3'] = $request->file('image_3')->store($folder, 'public');
        }
        if ($request->hasFile('image_4')) {
            $data['image_4'] = $request->file('image_4')->store($folder, 'public');
        }

        // Crear el producto
        $producto = Producto::create($data);

        // Si se seleccionó la opción de añadir stock y almacén
        if ($request->has('add_stock')) {
            Logistica::create([
                'Id_usuario' => Auth::id(),
                'Id_Producto' => $producto->Id_Producto,
                'Id_Almacen' => $request->almacen_id,
                'stock' => $request->stock,
            ]);
        }

        return redirect()->route('admin.productos.index')->with('success', 'Producto añadido con éxito');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        // Validación, incluyendo la regla 'unique' para el campo 'Codigo_producto'
        $request->validate([
            'Codigo_producto' => 'required|string|max:255|unique:productos,Codigo_producto,' . $producto->Id_Producto . ',Id_Producto',
            'Nombre_producto' => 'required|string|max:255',
            'Descripcion' => 'required|string',
            'Precio' => 'required|numeric',
            'id_categoria' => 'required|integer|exists:categorias,id',
            'Talla' => 'required|string|max:255',
            'Color' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'Codigo_producto.unique' => 'El código del producto ya existe. Por favor, utilice un código diferente.', // Mensaje de error para el campo 'Codigo_producto'
        ]);

        // Preparación de los datos para la actualización
        $data = $request->except(['_token', '_method']);
        $folder = 'productos/' . $producto->Codigo_producto;
        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store($folder, 'public');
        }
        if ($request->hasFile('image_1')) {
            if ($producto->image_1) {
                Storage::disk('public')->delete($producto->image_1);
            }
            $data['image_1'] = $request->file('image_1')->store($folder, 'public');
        }
        if ($request->hasFile('image_2')) {
            if ($producto->image_2) {
                Storage::disk('public')->delete($producto->image_2);
            }
            $data['image_2'] = $request->file('image_2')->store($folder, 'public');
        }
        if ($request->hasFile('image_3')) {
            if ($producto->image_3) {
                Storage::disk('public')->delete($producto->image_3);
            }
            $data['image_3'] = $request->file('image_3')->store($folder, 'public');
        }
        if ($request->hasFile('image_4')) {
            if ($producto->image_4) {
                Storage::disk('public')->delete($producto->image_4);
            }
            $data['image_4'] = $request->file('image_4')->store($folder, 'public');
        }

        // Actualizar el producto
        $producto->update($data);

        // Redireccionar a la lista de productos con mensaje de éxito
        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado con éxito');
    }



    public function destroy($id)
    {
        // Obtener el producto
        $producto = Producto::findOrFail($id);

        // Obtener todos los registros de logística asociados al producto
        $logisticas = Logistica::where('Id_Producto', $id)->get();

        // Verificar si hay registros de logística
        if ($logisticas->isNotEmpty()) {
            // Verificar si algún registro de logística tiene stock mayor a cero
            $hasStock = $logisticas->some(function ($logistica) {
                return $logistica->stock > 0;
            });

            if (!$hasStock) {
                // Borrar todos los registros de logística asociados al producto
                foreach ($logisticas as $logistica) {
                    $logistica->delete();
                }
            } else {
                return redirect()->route('admin.productos.index')->with('error', 'El producto tiene stock en algún almacén y no se puede eliminar.');
            }
        }

        // Borrar la imagen del producto si existe
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        // Borrar el producto
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado con éxito');
    }
}
