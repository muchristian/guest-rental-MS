import React, { Component } from 'react';
import Form from '../UI/Form';
import Button from '../UI/Button';
import { Link } from 'react-router-dom';
import AuthLayout from '../AuthLayout';

export default class Signup extends Component {
    state = {
        signup: {
            firstName: {
                value: "",
                elType: 'input',
                elementConfig: {
                    type: "text",
                    placeholder: "Mark",
                    name: "firstName",
                    label: "First name",
                    class: "form-group has-float-label"
                }
            },
            lastName: {
                value: "",
                elType: 'input',
                elementConfig: {
                    type: "text",
                    placeholder: "Joe",
                    name: "lastName",
                    label: "Last name",
                    class: "form-group has-float-label"
                }
            },
            username: {
                value: "",
                elType: 'input',
                elementConfig: {
                    type: "text",
                    placeholder: "markJ@21",
                    name: "username",
                    label: "Username",
                    class: "form-group has-float-label"
                }
            },
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
            phoneNumber: {
                value: "",
                elType: 'input',
                elementConfig: {
                    type: "text",
                    placeholder: "07********",
                    name: "phoneNumber",
                    label: "Phone number",
                    class: "form-group has-float-label"
                }
            },
            gender: {
                value: "",
                elType: 'select',
                elementConfig: {
                    type: "select",
                    options: [{ value: 'male', label: 'male' },
                    { value: 'female', label: 'female' }],
                    class: "form-group"
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

    onchangeHandler(e, el) {
        const name = el;
        const field = {
          ...this.state.signup,
          [name]: {
            ...this.state.signup[name],
            value: e.target.value,
          }
        }
        this.setState({signup: field});
      }

    render() {
        let formArray = [];
        for (let key in this.state.signup) {
            formArray.push({
                id: key,
                config: this.state.signup[key]
            });
        }
        let formElement = (
            <form onSubmit={this.handleSubmit} className="ml-auto mr-auto pl-2 pr-1 col-sm-10 col-md-12 col-lg-12">
                <div className="signup-head pl-2 pr-2">
                                <h2>guems</h2>
                                <p>Login with your account <Link to="/login">login</Link></p>
                            </div>
                            <div className="row">
                {formArray.map(el => (
                    <div key={el.id} className={"col-6 col-sm-6 col-md-6 col-lg-6 pl-0" + " " + el.config.elementConfig.class}>
                    <Form
                        elementType={el.config.elType}
                        elementConfig={el.config.elementConfig}
                        value={el.config.value}
                        inputHandler={(e) => this.onchangeHandler(e, el.id)}
                    ></Form>
                    </div>
                ))}
                </div>
                <div className="mt-1 pl-2 pr-2"><Button btnType="button" text="Signup"/></div>
            </form>
        );
        return (
            <AuthLayout col1="col-md-6 col-lg-7" col2="col-sm-12 col-md-6 col-lg-5">
                {formElement}
            </AuthLayout>
        );
    }
}

