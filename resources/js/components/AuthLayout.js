import React, { Component } from "react";
import AuthImage from './UI/AuthImage';

export default class AuthLayout extends Component {
render() {
    return (
        <div className="row auth-container no-gutters">
                    <div className={"authimage-container" + " " + this.props.col1}>
                        <AuthImage/>
                    </div>
                    <div className={this.props.col2}>
                        <div className="auth-content row">
                            {this.props.children}
                        </div>
                    </div>
                </div>
    )
}
}
