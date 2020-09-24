import React, { Component, Fragment } from 'react';
import Form from '../UI/Form';
import Button from '../UI/Button';
import { Link } from 'react-router-dom';
import AuthLayout from '../AuthLayout';
import InputInfo from '../../utils/InputInfo';
import Stepper from './Stepper';

export default class Signup extends Component {
    
    state = {
        stepper: {
            Personal: null,
            Guest_house: null,
            Submission:null
        },
        signup: {
            Personal: {
                firstName: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('firstName')
                    }
                },
                lastName: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('lastName')
                    }
                },
                username: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('username')
                    }
                },
                email: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('email')
                    }
                },
                phoneNumber: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('phoneNumber')
                    }
                },
                gender: {
                    value: "",
                    elType: 'select',
                    elementConfig: {
                        ...InputInfo('gender')
                    }
                },
                password: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('password')
                    }
                }
            },
            Guest_house: {
                username: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('username')
                    }
                },
                email: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('email')
                    }
                },
                phoneNumber: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('phoneNumber')
                    }
                }
            }         
        },
        currentStep: 'Personal'
    }

    stepHandler(val) {
        let newStep = Object.keys(this.state.stepper);
        this.setState({currentStep: val === 'next' ? 
        newStep[newStep.indexOf(this.state.currentStep) + 1] : 
        newStep[newStep.indexOf(this.state.currentStep) - 1]});
    }

    onchangeHandler(e, el) {
        const name = el;
        const field = {
          ...this.state.signup,
          [this.state.currentStep]: {
            ...this.state.signup[this.state.currentStep],
            [name]: {
                ...this.state.signup[this.state.currentStep][name],
                value: e.target.value,
              }
          }
        }
        this.setState({signup: field});
      }
    

    render() {
        const {currentStep, signup, stepper} = this.state;
        const formArray = [];
        const initArr = signup[currentStep];
        for (let key in initArr) {
            formArray.push({
                id: key,
                config: initArr[key]
            });
        }
        let formElement = (
                <Fragment>
                    <div className="signup-head pl-2 pr-2 mb-3">
                                <h2>guems</h2>
                                <p>Login with your account <Link to="/login">login</Link></p>
                            </div>
                <Stepper stepper={stepper} currentStep={currentStep}/>
                <div className="stepper-body">
                                {this.props.currentStep === 'Submission' ?
                                    <div> well done</div>
                                :
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
                }
                            
                </div>
                </Fragment>
            );
        let button = null;
        switch(this.state.currentStep) {
            case 'Personal':
                button = <Button btnType="button" id={this.state.currentStep} text="Next" stepHandler={() => this.stepHandler('next')}/>
                break;
            case 'Guest_house':
                button = (
                    <Fragment>
                    <Button btnType="button" id={this.state.currentStep} text="Back" stepHandler={() => this.stepHandler('prev')}/>
                    <Button btnType="button" id={this.state.currentStep} text="Next" stepHandler={() => this.stepHandler('next')}/>
                    </Fragment>
                )
                break;
            case 'Submission': 
                button = (
                    <Fragment>
                    <Button btnType="submit" id={this.state.currentStep} text="Signup"/>
                    <Button btnType="button" id={this.state.currentStep} text="Back" stepHandler={() => this.stepHandler('prev')}/>
                    </Fragment>
                )
                break;
        }
        return (
            <AuthLayout col1="col-md-6 col-lg-7" col2="col-sm-12 col-md-6 col-lg-5">
                <form onSubmit={this.handleSubmit} className="ml-auto mr-auto pl-2 pr-1 col-sm-10 col-md-12 col-lg-12">
                {formElement}
                <div className="mt-1 pl-2 pr-2 d-flex justify-content-end">
                {button}
                </div>
                </form>
            </AuthLayout>
        );
    }
}

