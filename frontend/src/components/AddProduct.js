import React, { useState } from 'react'
import axios from 'axios';
import {useNavigate} from 'react-router-dom';

const AddProduct = () => {

    // usestate untuk title dan price
    const [title, setTitle] = useState('');
    const [price, setPrice] = useState('');
    const navigate = useNavigate();

    // menyimpan data masukan dari form
    const saveProduct = async (e) => {
        e.preventDefault();
        await axios.post('http://localhost:8081/products', {
            title: title,
            price: price
        });
        navigate('/'); // redirect halaman
    }

  return (
    <div>
        <form onSubmit={saveProduct}>
            <div className='field'>
                <label className='label'>Title</label>
                <input type='text' className='input' placeholder='Insert title here...' value={title} onChange={ (e) => setTitle(e.target.value) } />
            </div>
            <div className='field'>
                <label className='label'>Price</label>
                <input type='text' className='input' placeholder='Insert price here...' value={price} onChange={ (e) => setPrice(e.target.value) } />
            </div>
            <div className='field'>
                <button className='button is-primary'>Add</button>
            </div>
        </form>
    </div>
  )
}

export default AddProduct