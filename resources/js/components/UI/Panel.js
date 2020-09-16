import React, { Component, Fragment } from 'react';
import PanelComponent from './PanelComponent';

export default class Panel extends Component {

    render() {
        let element = null;
        //element = <PanelComponent panel="ADMIN"></PanelComponent>
        if ("ADMIN") {
            element = <PanelComponent panel="ADMIN"></PanelComponent>
        }
        return ( 
<Fragment>
    <div id="sidebar-container" className="sidebar-expanded bg-dark">
         
        <ul className="list-group"> 
            <li className="list-group-item sidebar-separator-title text-muted align-items-center menu-collapsed">
        <small>MAIN MENU</small>
            </li> 
            <li>
            <a href="#" className="list-group-item list-group-item-action bg-dark">
                <div className="d-flex w-100 justify-content-start align-items-center">
                    <span className="ti-dashboard mr-3"></span>
                    <span className="text-xs menu-collapsed">Dashboard</span>
                </div>
            </a>
            </li>
            
            
                
     {element}
        </ul>
    </div>
 </Fragment>
        )
    }
}