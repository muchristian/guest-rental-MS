import React from 'react';


function CardBox(props) {
return (
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
)
}

export default CardBox;