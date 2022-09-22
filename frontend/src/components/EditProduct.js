/* eslint-disable react-hooks/exhaustive-deps */
import React, { useState, useEffect } from 'react'
import axios from 'axios';
import {useNavigate, useParams} from 'react-router-dom';

const EditProduct = () => {

    // usestate untuk title dan price
    const [title, setTitle] = useState('');
    const [price, setPrice] = useState('');
    const navigate = useNavigate(); // inisiasi untuk redirect
    const { id } = useParams(); // inisiasi untuk ambil parameter id

    // menyimpan data masukan dari form
    const updateProduct = async (e) => {
        e.preventDefault();
        await axios.patch(`http://localhost:8081/products/${id}`, {
            title: title,
            price: price
        });
        navigate('/'); // redirect halaman
    }

    useEffect(() => {
        getProductById(); // dari method getProductById
    },[]);

    // method untuk mengambil id dari param
    const getProductById = async () => {
        const response = await axios.get(`http://localhost:8081/products/${id}`);
        setTitle(response.data.title); // ambil data title berdasarkan id
        setPrice(response.data.price); // ambil data price berdasarkan id
    }

  return (
    <div>
        <form onSubmit={updateProduct}>
            <div className='field'>
                <label className='label'>Title</label>
                <input type='text' className='input' placeholder='Insert title here...' value={title} onChange={ (e) => setTitle(e.target.value) } />
            </div>
            <div className='field'>
                <label className='label'>Price</label>
                <input type='text' className='input' placeholder='Insert price here...' value={price} onChange={ (e) => setPrice(e.target.value) } />
            </div>
            <div className='field'>
                <button className='button is-primary'>Update</button>
            </div>
        </form>
    </div>
  )
}

export default EditProduct