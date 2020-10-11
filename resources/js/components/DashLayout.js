import React, { Component, Fragment } from 'react';
import Panel from './UI/Panel';
import Navbar from './UI/Navbar';
import Breadcrumb from './UI/Breadcrumb';
import Customize from './Customize/Customize';
import UpdateModal from './UI/UpdateModal';
import ReactDOM from 'react-dom';

export default class DashLayout extends Component {
    state = {
        sidebar_toggle: false
    }
    sidebarToggle = () => {
        this.setState({sidebar_toggle: !this.state.sidebar_toggle})
        }
        //SidebarCollapse () {
        //      
        //      $('.menu-collapsed').toggleClass('d-none');
        //          $('.submenu-icon').toggleClass('d-none');
        //          $(".sidebar-submenu").toggleClass('d-none');
        //          
        //          $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
        //          
        //          // Treating d-flex/d-none on separators with title
        //          replaceClass()
        //          
        //          // Collapse/Expand icon
        //          $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
        //      }
        //      replaceClass() {
        //        let SeparatorTitle = $('.sidebar-separator-title');
        //        let sidebarContainer = $('#sidebar-container');
        //        if ( SeparatorTitle.hasClass('d-flex') 
        //        && sidebarContainer.hasClass('sidebar-collapsed')) {
        //            SeparatorTitle.removeClass('d-flex');
        //        } else {
        //                SeparatorTitle.addClass('d-flex');
        //        }
        //    }
    render() {

        return (
            <Fragment>
            <Navbar sidebartoggle={this.sidebarToggle}/>
            <div className="row">
            <Panel sidebar_toggle={this.state.sidebar_toggle}/>
            <UpdateModal show={false}/>
            <div className="col content-col">
            <div className="d-sm-flex align-items-center justify-content-between mb-4">
            <Breadcrumb/>
          </div>
          <Customize/>
          
        {this.props.children}
    </div>
    </div>
        </Fragment>
        )
    }
}