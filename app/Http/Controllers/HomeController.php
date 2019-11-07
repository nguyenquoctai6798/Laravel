<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\products;
    use Auth;
    use File;  
    use Illuminate\Support\Facades\Validator;
    // use App\Entities\Models\User;

    class HomeController extends Controller
    {

        public function index()
        {
            if (Auth::check() && Auth::user()->email_verified_at == 1) {
                $result = products::getAllProduct();
                $name = Auth::user()->name;
                return view('User.HomeView', ['lsProduct' => $result, 'name' => $name]);
            }
            else{
                return redirect('/Login');
            }
        }

        public function deleteProduct($id){
            if (Auth::check() && Auth::user()->email_verified_at == 1) {
                products::deleteProduct($id);
                return redirect('/')->with('success', 'Xóa sản phẩm thành công');
            }
            else{
                return redirect('/Login');
            }
        }

        public function editProduct($id){
            if (Auth::check() && Auth::user()->email_verified_at == 1) {
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
            $fileRandom = null;
            if($request->hasFile('myfile')){
                $file = $request->file('myfile');
                $duoi = $file->getClientOriginalExtension();
                if($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg" && $duoi != "JPG" && $duoi != "PNG" && $duoi != "JPEG" ){
                    return redirect()->back()->with('error', 'Chỉ được thêm file .jpg/.png/.jpeg')->withInput(
                        $request->except('')
                    );
                }
                else{
                    // xóa file product cũ
                    $product = products::getProductId($id);
                    $uploadDir = public_path('Images');
                    if(File::exists($uploadDir. '/' . $product[0]->Img)){
                        File::delete($uploadDir. '/' . $product[0]->Img);
                    }
                    else{
                        return redirect()->back()->with('error', 'file hình không tìm thấy để xóa');
                    }
                    // thêm file product mới
                    $fileName = $file->getClientOriginalName();
                    $fileRandom = str_random(8). '_' .$fileName;
                    $file->move('public/Images',$fileRandom);
                   
                }
            }
            products::editProduct($request, $id, $fileRandom);
            return redirect('/')->with('success', 'Thay đối sản phẩm thành công');
        }

        public function showProductDetail($id){
           
            if (Auth::check() && Auth::user()->email_verified_at == 1) {
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
                    $duoi = $file->getClientOriginalExtension();
                    if($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg" && $duoi != "JPG" && $duoi != "PNG" && $duoi != "JPEG" ){
                        return redirect()->back()->with('error', 'Chỉ được thêm file .jpg/.png/.jpeg')->withInput(
                            $request->except('')
                        );
                    }
                    else{
                        $fileName = $file->getClientOriginalName();
                        $fileRandom = str_random(8). '_' .$fileName;
                        $file->move('public/Images',$fileRandom);
                        products::creteProductPost($request, $fileRandom);
                        return redirect('/')->with('success', 'Thêm sản phẩm mới thành công!'); 
                    }
                  
                }
            }
    }
