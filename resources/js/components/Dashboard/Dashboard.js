import React, { Component, Fragment } from 'react';
import DashLayout from '../DashLayout';


export default class Dashboard extends Component {
    render() {
        return (
        <DashLayout>
                      <div className="row">


<div className="col-xl-3 col-md-6 mb-4">
  <div className="card border-left-primary shadow h-100 py-2">
    <div className="card-body">
      <div className="row no-gutters align-items-center">
        <div className="col mr-2">
          <div className="text-xs font-weight-light text-primary text-uppercase mb-1">Earnings (Monthly)</div>
          <div className="h5 mb-0 font-weight-normal">$40,000</div>
        </div>
        <div className="col-auto">
          <i className="ti-calendar text-xxlg"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div className="col-xl-3 col-md-6 mb-4">
              <div className="card border-left-success shadow h-100 py-2">
                <div className="card-body">
                  <div className="row no-gutters align-items-center">
                    <div className="col mr-2">
                      <div className="text-xs font-weight-light text-success text-uppercase mb-1">Earnings (Annual)</div>
                      <div className="h5 mb-0 font-weight-normal">$215,000</div>
                    </div>
                    <div className="col-auto">
                      <i className="fa fa-dollar-sign text-xxlg"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div className="col-xl-3 col-md-6 mb-4">
              <div className="card border-left-info shadow h-100 py-2">
                <div className="card-body">
                  <div className="row no-gutters align-items-center">
                    <div className="col mr-2">
                      <div className="text-xs font-weight-light text-info text-uppercase mb-1">Tasks</div>
                      <div className="h5 mb-0 mr-3 font-weight-normal">50%</div>
                    </div>
                    <div className="col-auto">
                      <i className="ti-clipboard text-xxlg"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>

              <div className="col-xl-3 col-md-6 mb-4">
              <div className="card border-left-warning shadow h-100 py-2">
                <div className="card-body">
                  <div className="row no-gutters align-items-center">
                    <div className="col mr-2">
                      <div className="text-xs font-weight-light text-warning text-uppercase mb-1">Pending Requests</div>
                      <div className="h5 mb-0 font-weight-normal">18</div>
                    </div>
                    <div className="col-auto">
                      <i className="fa fa-comments text-xxlg "></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>
        </DashLayout>
        )
    }
}