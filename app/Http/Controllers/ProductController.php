<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProducts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $request;
    protected $repository;

    public function __construct(Request $request, Product $product)
    {
        $this->request = $request;
        $this->repository = $product;

        // -> Para adicionar o middleware a todos os métodos.
        //$this->middleware('auth');
        // -> Para adicionar o middleware a apenas alguns métodos.
        //$this->middleware('auth')->only(['create', 'store']);
        // -> Para adicionar o middleware a todos exceto a alguns métodos.
        //$this->middleware('auth')->except(['destroy', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->repository->search(request()->get('filter'));

        return view('admin.pages.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProducts  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUpdateProducts $request)
    {
        //$request->validate([
        //    'photo' => 'required|image',
        //    'name' => 'required|min:3|max:255',
        //    'descrition' => 'nullable|min:3|max:10000',
        //]);

        //dd($request->all());
        //Outras formas de pegar os campos.
        //dd($request->except('_token'));
        //dd($request->input('name', 'default'));
        //dd($request->only('name', 'description'));
        //dd($request->name); ou dd($request->description);

        //Upload de arquivo.
        //Lembrando que no form deve haver 'enctype="multipart/form-data"';
        //A foto pode ser pega com a seguinte sintaxe: $request->photo onde photo é o nome do input no form.
        //if ($request->file('photo')->isValid()) {
            //Salva o arquivo com um nome aleatório gerado.
            //A string passada dentro de 'store' é o nome da pasta que será criada dentro de storage/app.
            //$request->file('photo')->store('products');
            //Salva o arquivo com um nome passado.
            //$request->file('photo')->storeAS('products', 'nomeinveantado.'.$request->file('photo')->extension());
            //Para salvar as imagens de forma pública, é necessário que se altere o arquivo em config/filesystems.php e alterar para public.
            //Neste caso para que os arquivos fiquem acessiveis de forma pública é necessário criar um link simbólico da pasta /storage/public
            //e para isso o artisan tem o comando 'php artisan storage:link' e ai só acessar os arquivos via url.
        //}

        $data = $request->only(['name', 'description', 'price']);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store('products');
        }

        $this->repository->create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        //$product = Product::find($id);
        // ou
        //$product = Product::where('id', $id)->first();
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProducts  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateProducts $request, $id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }
        $data = $request->only(['name', 'description', 'price']);

        if ($request->hasFile('image') && $request->image->isValid()) {
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $data['image'] = $request->image->store('products');
        }

        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index');
    }
}
