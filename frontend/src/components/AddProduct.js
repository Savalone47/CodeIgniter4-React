import React, { useState } from 'react'
import { useNavigate } from 'react-router-dom';
import axios from "axios";
 
const AddProduct = () => {
    const [title, setTitle] = useState('');
    const [price, setPrice] = useState('');
    const navigate = useNavigate();
 
    const saveProduct = async (e) => {
        e.preventDefault();
        await axios.post('http://localhost:8080/products',{
            title: title,
            price: price
        });
        navigate("/");
    }
 
    return (
        <div>
            <form onSubmit={ saveProduct }>
                <div className="field">
                    <label className="label">Titre</label>
                    <input 
                        type="text"
                        className="input"
                        value={ title } 
                        onChange={ (e) => setTitle(e.target.value) }
                        placeholder="Titre"
                    />
                </div>
                <div className="field">
                    <label className="label">Prix</label>
                    <input 
                        type="text"
                        className="input"
                        value={ price } 
                        onChange={ (e) => setPrice(e.target.value) }
                        placeholder="Prix"
                    />
                </div>
                <div className="field">
                    <button className="button is-primary">Save</button>
                </div>
            </form>
        </div>
    )
}
 
export default AddProduct