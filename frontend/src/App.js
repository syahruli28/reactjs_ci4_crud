import {
  BrowserRouter,
  Routes,
  Route,
} from "react-router-dom";
import EditProduct from "./components/EditProduct";
import ProductList from "./components/ProductList";
import AddProduct from "./components/AddProduct";

function App() {
  return (
    <BrowserRouter>
      <div className="container">
        <Routes>
          <Route path='/' element={<ProductList />}></Route>            
          <Route path='/add' element={<AddProduct />}></Route>
          <Route path='/edit/:id' element={<EditProduct />}></Route>
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
