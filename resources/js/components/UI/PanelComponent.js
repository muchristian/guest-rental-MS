import React, { Component, Fragment } from 'react';
class PanelComponent extends Component {

   
    
     render () {
        
          
             switch(this.props.panel) {
                case 'SUPER_ADMIN':
                    return (
                        <Fragment>
                            <li className="drop-menu position-relative">
                        <a href="#users" data-toggle="collapse" aria-expanded="false" className="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div className="d-flex w-100 justify-content-start align-items-center">
                        <span className="fa fa-users mr-3"></span>
                        <span className="text-xs menu-collapsed">Users</span>
                        <span className="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='users' className="collapse sidebar-submenu">
                    <a href="#" className="list-group-item list-group-item-action bg-dark">
                        <span className="ti-angle-right mr-3"></span>
                        <span className="text-xs submenu-collapsed">User verifications</span>
                    </a>
                </div> 
                </li>
                <li>
                <a href="#" className="bg-dark list-group-item list-group-item-action">
                    <div className="d-flex w-100 justify-content-start align-items-center">
                        <span className="fa fa-home mr-3"></span>
                        <span className="text-xs menu-collapsed">Guest houses</span>
                    </div>
                </a>
                </li>
                <li className="drop-menu position-relative">
                <a href="#settings" data-toggle="collapse" aria-expanded="false" className="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                            <div className="d-flex w-100 justify-content-start align-items-center">
                                <span className="ti-settings mr-3"></span>
                                <span className="text-xs menu-collapsed">Settings</span>
                                <span className="submenu-icon ml-auto"></span>
                            </div>
                        </a>
                <div id='settings' className="collapse sidebar-submenu">
                        <a href="#" className="list-group-item list-group-item-action bg-dark">
                                <span className="ti-angle-right mr-3"></span>
                                <span className="text-xs submenu-collapsed">Website control</span>
                            </a>
                            <a href="#" className="list-group-item list-group-item-action bg-dark">
                                <span className="ti-angle-right mr-3"></span>
                                <span className="text-xs submenu-collapsed">Customize</span>
                            </a>
                        </div>
                        </li>
                </Fragment>
                    )
                    
                case 'ADMIN':
                        return (
                            <Fragment>
                <li>
                <a href="#" className="bg-dark list-group-item list-group-item-action">
                    <div className="d-flex w-100 justify-content-start align-items-center">
                        <span className="fa fa-bed fa-fw mr-3"></span>
                        <span className="text-xs menu-collapsed">Rooms</span>
                    </div>
                </a>
                </li>
                <li>
                <a href="#" className="bg-dark list-group-item list-group-item-action">
                    <div className="d-flex w-100 justify-content-start align-items-center">
                        <span className="fa fa-users fa-fw mr-3"></span>
                        <span className="text-xs menu-collapsed">Guests</span>
                    </div>
                </a>
                </li>
                <li className="drop-menu position-relative">
                <a href="#service" data-toggle="collapse" aria-expanded="false" className="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div className="d-flex w-100 justify-content-start align-items-center">
                        <span className="fa fa-beer fa-fw mr-3"></span>
                        <span className="text-xs menu-collapsed">Services</span>
                        <span className="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='service' className="collapse sidebar-submenu">
                <a href="#" className="list-group-item list-group-item-action bg-dark">
                        <span className="ti-angle-right mr-3"></span>
                        <span className="text-xs submenu-collapsed">Control services</span>
                    </a>
                    <a href="#" className="list-group-item list-group-item-action bg-dark">
                        <span className="ti-angle-right mr-3"></span>
                        <span className="text-xs submenu-collapsed">Assign services</span>
                    </a>
                </div>
                </li> 
                <li className="drop-menu position-relative">
                            <a href="#settings" data-toggle="collapse" aria-expanded="false" className="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                            <div className="d-flex w-100 justify-content-start align-items-center">
                                <span className="ti-settings mr-3"></span>
                                <span className="text-xs menu-collapsed">Settings</span>
                                <span className="submenu-icon ml-auto"></span>
                            </div>
                        </a>
                        <div id='settings' className="collapse sidebar-submenu">
                        <a href="#" className="list-group-item list-group-item-action bg-dark">
                                <span className="ti-angle-right mr-3"></span>
                                <span className="text-xs submenu-collapsed">House control</span>
                            </a>
                        </div>
                        </li>
                        </Fragment>
                        )
                        }
     }
}

export default PanelComponent;