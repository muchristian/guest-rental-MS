import React, { Component } from 'react';
import Form from '../UI/Form';
import Button from '../UI/Button';
import { Link } from 'react-router-dom';
import AuthLayout from '../AuthLayout';
import InputInfo from '../../utils/InputInfo';

export default class ForgetPassword extends Component {
    state = {
        forget_password: {
            email: {
                value: "",
                elType: 'input',
                elementConfig: {
                    ...InputInfo('email')
                }
            }
        }
    }


    render() {
        let formArray = [];
        for (let key in this.state.forget_password) {
            formArray.push({
                id: key,
                config: this.state.forget_password[key]
            });
        }
        let formElement = (
            <form onSubmit={this.handleSubmit} className="ml-auto mr-auto col-sm-9 col-md-11 col-lg-11">
                <div className="forget-pw-head">
                                <h2>guems</h2>
                                <p>Login with your account <Link to="/login">login</Link></p>
                            </div>
                {formArray.map(el => (
                    <div key={el.id} className={el.config.elementConfig.class}>
                    <Form
                        key={el.id}
                        elementType={el.config.elType}
                        elementConfig={el.config.elementConfig}
                        value={el.config.value}
                    ></Form>
                    </div>
                ))}
                <Button btnType="button" text="Submit"/>
            </form>
        );
        return (
            <AuthLayout col1="col-md-7 col-lg-8" col2="col-sm-12 col-md-5 col-lg-4">
                {formElement}
            </AuthLayout>
        );
    }
}

