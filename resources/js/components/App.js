import React, { Component } from 'react';
import Login from './Login/Login';
import ForgetPassword from './ForgetPassword/ForgetPassword';
import Dashboard from './Dashboard/Dashboard';
import Signup from './Signup/Signup';
import Userview from './User/UserView';
import { Route, Switch } from 'react-router-dom';

export default class App extends Component {
    state={
        isLoading: true
    }
    
    
    render() {
        setTimeout(
            function() {
              this.setState({ isLoading: false });
            }.bind(this),
            3000
          );
        return (
            <div>
                {this.state.isLoading ? 
                <span>Loading....</span>
                :
                <Switch>
            <Route path="/admin">
                <Dashboard/>
            </Route>
            <Route path="/view">
                <Userview/>
            </Route>
            <Route path="/signup">
                <Signup/>
            </Route>
            <Route path="/login">
                <Login/>
            </Route>
            <Route path="/forget-password">
                <ForgetPassword/>
            </Route>
            <Route exact path="/">
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Example Component</div>
                            <button>well</button>
                            <div className="card-body">I'm fdsafdsa an example component!</div>
                        </div>
                    </div>
                </div>
            </div>
            </Route>
        </Switch>}
            </div>            
        );
    }
}
