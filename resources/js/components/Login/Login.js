import React, { Component } from 'react';
import Form from '../UI/Form';
import Button from '../UI/Button';
import { Link } from 'react-router-dom';
import AuthLayout from '../AuthLayout';

export default class Login extends Component {
    state = {
        login: {
            email: {
                value: "",
                elType: 'input',
                elementConfig: {
                    type: "email",
                    placeholder: "markjoe213@mail.com",
                    name: "email",
                    label: "Email",
                    class: "form-group has-float-label"
                }
            },
            password: {
                value: "",
                elType: 'input',
                elementConfig: {
                    type: "password",
                    placeholder: "markJoe@213",
                    name: "password",
                    label: "Password",
                    class: "form-group has-float-label"
                }
            }
        }
    }


    render() {
        let formArray = [];
        for (let key in this.state.login) {
            formArray.push({
                id: key,
                config: this.state.login[key]
            });
        }
        let formElement = (
            <form onSubmit={this.handleSubmit} className="ml-auto mr-auto col-sm-9 col-md-11 col-lg-11">
                <div className="login-head">
                                <h2>guems</h2>
                                <p>Create an account <Link to="/signup">signup</Link></p>
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
                <p className="fp-link"><Link to="/forget-password">Forget password</Link></p>
                <Button btnType="button" text="Login"/>
            </form>
        );
        return (
            <AuthLayout col1="col-md-7 col-lg-8" col2="col-sm-12 col-md-5 col-lg-4">
                {formElement}
            </AuthLayout>
        );
    }
}

