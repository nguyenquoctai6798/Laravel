<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\products;
    use Auth;
    use Illuminate\Support\Facades\Validator;
    // use App\Entities\Models\User;

    class HomeController extends Controller
    {

        public function index()
        {
            if (Auth::check()) {
                $result = products::getAllProduct();
                $name = Auth::user()->name;
                return view('User.HomeView', ['lsProduct' => $result, 'name' => $name]);
            }
            else{
                return redirect('/Login');
            }
        }

        public function deleteProduct($id){
            if (Auth::check()) {
                products::deleteProduct($id);
                return redirect('/')->with('success', 'Xóa sản phẩm thành công');
            }
            else{
                return redirect('/Login');
            }
        }

        public function editProduct($id){
            if (Auth::check()) {
                $product = products::getProductId($id);
                return view('User.EditProduct', ['product' => $product]);
            }
            else{
                return redirect('/Login');
            }
        }

        public function editProductPost(Request $request, $id){
            $validator = Validator::make($request->all(), [
                'Name' => 'required|min:6',
                'Price' => 'required|numeric',
                'Description' => 'required|min:10',
            ]);

            if ($validator->fails()) {
                $request->session()->flash('errors', $validator->errors());
                return redirect()->back();
            }
            $fileName = null;
            if($request->hasFile('myfile')){
                $file = $request->file('myfile');
                // dd($file);
                $fileName = pathinfo($_FILES['myfile']['name'], PATHINFO_BASENAME);
                $file->move('public/Images',$fileName);
            }
            products::editProduct($request, $id, $fileName);
            return redirect('/')->with('success', 'Thay đối sản phẩm thành công');
        }

        public function showProductDetail($id){
            if (Auth::check()) {
                $product = products::getProductId($id);
                return view('User.ShowProductDetail', ['product' => $product]);
            }
            else{
                return redirect('/Login');
            }
        }
        
        public function createProduct(){
            if (Auth::check()) {
                return view('User.CreateProduct');
            }
            else{
                return redirect('/Login');
            }
        }

        public function creteProductPost(Request $request){
            
                $validator = Validator::make($request->all(),[
                    'Name' => 'required|min:6',
                    'Price' => 'required|numeric',
                    'Description' => 'required|min:10',
                    'myfile' => 'required|max:10000'
                ]);
                if($validator->fails()){
                    $request->session()->flash('errors', $validator->errors());
                    $input = $request;
                    return redirect()->back();
                }
                if($request->hasFile('myfile')){
                    $file = $request->file('myfile');
                    // dd($file);
                    $fileName = pathinfo($_FILES['myfile']['name'], PATHINFO_BASENAME);
                    $file->move('public/Images',$fileName);
                    products::creteProductPost($request, $fileName);
                    return redirect('/')->with('success', 'Thêm sản phẩm mới thành công!'); 
                }
            }
    }
