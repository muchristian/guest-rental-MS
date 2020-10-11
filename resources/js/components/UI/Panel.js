import React, { Component, Fragment } from 'react';
import PanelComponent from './PanelComponent';

export default class Panel extends Component {

    componentDidMount() {
        let el  = document.getElementsByClassName('menu-collapsed');
        let el1 = document.getElementsByClassName('submenu-icon');
        let el2 = document.getElementsByClassName('sidebar-submenu');
        for(let i = 0; i < el.length; i++) {
            if (this.props.sidebar_toggle) {
                el[i].classList.add('d-none');
                if (el1[i] && el2[i]) {
                el1[i].classList.add('d-none');
                el2[i].classList.add('d-none');
                }
            } else {
                el[i].classList.remove('d-none');
                if (el1[i] && el2[i]) {
                    el1[i].classList.remove('d-none');
                    el2[i].classList.remove('d-none');
                }
                
            }
            
        }
    }
    componentDidUpdate(prevProps) {
        let el  = document.getElementsByClassName('menu-collapsed');
        let el1 = document.getElementsByClassName('submenu-icon');
        let el2 = document.getElementsByClassName('sidebar-submenu');
        if (prevProps.sidebar_toggle !== this.props.sidebar_toggle) {
            for(let i = 0; i < el.length; i++) {
                console.log(el1[i]);
                if (this.props.sidebar_toggle) {
                    el[i].classList.add('d-none');
                    if (el1[i] && el2[i]) {
                        el1[i].classList.add('d-none');
                        el2[i].classList.add('d-none');
                    }
                } else {
                    el[i].classList.remove('d-none');
                    if (el1[i] && el2[i]) {
                    el1[i].classList.remove('d-none');
                    el2[i].classList.remove('d-none');
                    }
                }
            }
        }
    }

    render() {
        console.log(this.props.sidebar_toggle)
        let element = null;
        //element = <PanelComponent panel="ADMIN"></PanelComponent>
        if ("ADMIN") {
            element = <PanelComponent panel="ADMIN"></PanelComponent>
        }
        return ( 
<Fragment>
    <div id="sidebar-container" className={`bg-dark ${this.props.sidebar_toggle ? 'sidebar-collapsed' : 'sidebar-expanded'}`}>
         
        <ul className="list-group"> 
            <li className={`list-group-item sidebar-separator-title text-muted align-items-center menu-collapsed ${this.props.sidebar_toggle && 'd-none'} `}>
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