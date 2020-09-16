import React, { Component } from 'react';
import image_profile from './icons8-male-user-100.png';

export default class Navbar extends Component {
    render() {
        return (
<nav className="navbar navbar-expand-lg topbar navbar-light bg-light ">
<a href="#" data-toggle="sidebar-colapse" className="d-flex justify-content-center align-items-center">
                <i className="ti-menu"></i>
            </a> 
  <div className="container-fluid">
  <a className="navbar-brand" href="#">Navbar</a>

  <div className="collapse navbar-collapse" id="navbarSupportedContent">
  <ul className="navbar-nav ml-auto">
<li className="nav-item dropdown no-arrow d-sm-none">
  <a className="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i className="fa fa-search fa-fw"></i>
  </a>
  <div className="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
    <form className="form-inline mr-auto w-100 navbar-search">
      <div className="input-group">
        <input type="text" className="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"/>
        <div className="input-group-append">
          <button className="btn btn-primary" type="button">
            <i className="fa fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</li>

<li className="nav-item dropdown no-arrow mx-1">
  <a className="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i className="fa fa-bell fa-fw"></i>
    <span className="badge badge-primary badge-counter text-white">3+</span>
  </a>
  <div className="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
    <h6 className="dropdown-header">
      Alerts Center
    </h6>
    <a className="dropdown-item d-flex align-items-center" href="#">
      <div className="mr-3">
        <div className="icon-circle bg-primary">
          <i className="fa fa-file-alt text-white"></i>
        </div>
      </div>
      <div>
        <div className="small">December 12, 2019</div>
        <span className="font-weight-bold">A new monthly report is ready to download!</span>
      </div>
    </a>
    <a className="dropdown-item d-flex align-items-center" href="#">
      <div className="mr-3">
        <div className="icon-circle bg-success">
          <i className="fa fa-donate text-white"></i>
        </div>
      </div>
      <div>
        <div className="small">December 7, 2019</div>
        $290.29 has been deposited into your account!
      </div>
    </a>
    <a className="dropdown-item d-flex align-items-center" href="#">
      <div className="mr-3">
        <div className="icon-circle bg-warning">
          <i className="fa fa-exclamation-triangle text-white"></i>
        </div>
      </div>
      <div>
        <div className="small">December 2, 2019</div>
        Spending Alert: We've noticed unusually high spending for your account.
      </div>
    </a>
    <a className="dropdown-item text-center small" href="#">Show All Alerts</a>
  </div>
</li>

<div className="topbar-divider d-none d-sm-block"></div>


<li className="nav-item dropdown no-arrow">
  <a className="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span className="mr-2 d-none d-lg-inline small">Valerie Luna</span>
    <img className="img-profile rounded-circle" src={image_profile}/>
  </a>
  <div className="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <a className="dropdown-item" href="#">
      <i className="fa fa-user fa-sm fa-fw mr-2"></i>
      Profile
    </a>
    <a className="dropdown-item" href="#">
      <i className="fa fa-cogs fa-sm fa-fw mr-2"></i>
      Settings
    </a>
    <a className="dropdown-item" href="#">
      <i className="fa fa-list fa-sm fa-fw mr-2"></i>
      Activity Log
    </a>
    <div className="dropdown-divider"></div>
    <a className="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
      <i className="fa fa-sign-out-alt fa-sm fa-fw mr-2"></i>
      Logout
    </a>
  </div>
</li>

</ul>
  </div>
  </div>
</nav>
        )
    }
}