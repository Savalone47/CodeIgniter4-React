import React from 'react';
import './App.css';
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import ProductList from "./components/ProductList";
import AddProduct from "./components/AddProduct";
import EditProduct from "./components/EditProduct";
class App extends React.Component {
  render(){
    return(
      <Router>
        <div className='container'>
          <Routes>
            <Route exact path='/' element={<ProductList/>} />
            <Route path='/add' element={<AddProduct/>} />
            <Route path='/edit/:id' element={<EditProduct/>} />
          </Routes>
        </div>
      </Router>
    );
  }
}

export default App;
