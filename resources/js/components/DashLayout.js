import React, { Component, Fragment } from 'react';
import Panel from './UI/Panel';
import Navbar from './UI/Navbar';
import Breadcrumb from './UI/Breadcrumb';
import Customize from './Customize/Customize';
import UpdateModal from './UI/UpdateModal';

export default class DashLayout extends Component {
    render() {
        return (
            <Fragment>
            <Navbar/>
            <div className="row">
            <Panel/>
            <UpdateModal show={true}/>
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