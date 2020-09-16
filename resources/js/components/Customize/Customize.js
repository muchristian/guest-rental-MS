import React, { Component } from 'react';

class Customize extends Component {
  render() {
    return (
      <div className="customize customize-hidden">
            <span className="customize-toggle fa fa-cogs" id="customize-toggle" aria-hidden="true"></span>    
            <div className="customize-content">
            <div className="customize-head mb-2">
              <h5>Customize</h5>
              </div>
              <div className="form-group">
                  <p>Mode:</p>
              <div className="form-check form-check-inline">
                <input id="inlineCheckbox1" className="form-check-input" type="checkbox" data-toggle="toggle" data-style="ios" data-onstyle="secondary" checked/>
                <label for="inlineCheckbox1" className="pl-2 form-check-label">Enabled</label>
              </div>
              </div>
            </div>
            </div>
  )
  }

}

export default Customize;