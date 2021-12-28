import React,{Component} from 'react'
import { Head } from '@inertiajs/inertia-react'
import Navbar from '../components/Navbar'

const Index = ({auth})=>{
    return(
        <>
            <Navbar auth={auth}/>
            <div className='container mt-5'>
                <h1 className='mb-5'>Selamat datang {auth.name}</h1>
                <table style={{width:'300px'}}>
                    <tr>
                        <td>Total Transaksi</td>
                        <td>: 10</td>
                    </tr>
                </table>
            </div>
        </>
    )
}
export default Index
