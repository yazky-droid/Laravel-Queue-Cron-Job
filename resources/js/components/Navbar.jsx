import React from "react";
import { Link } from "@inertiajs/inertia-react";
import { usePage } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

const Navbar = ({auth})=>{
    // console.log(auth)
    const {csrf} = usePage().props
    return(
    <nav className="navbar navbar-expand-lg navbar-light bg-light">
        <div className="container">
          <Link className="navbar-brand" href="/">Transaksi</Link>
          <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon" />
          </button>
          <div className="collapse navbar-collapse" id="navbarNavDropdown">
            <ul className="navbar-nav ms-auto">
              <li className="nav-item">
                <Link className="nav-link" href="/">Home</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" href="/tambah-transaksi">Tambah Transaksi</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" href="/lihat-transaksi">Lihat Transaksi</Link>
              </li>
              <li className="nav-item dropdown">
                <Link className="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {auth.name}
                </Link>
                <ul className="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><button className="dropdown-item" onClick={()=>{
                    Inertia.post('logout',{_token:csrf})
                    window.location.href = '/login'
                  }}>Logout</button></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    )
}
export default Navbar
