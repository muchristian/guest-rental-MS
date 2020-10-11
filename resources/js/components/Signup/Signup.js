import React, { Component, Fragment } from 'react';
import Form from '../UI/Form';
import Button from '../UI/Button';
import { Link } from 'react-router-dom';
import AuthLayout from '../AuthLayout';
import InputInfo from '../../utils/InputInfo';
import Stepper from './Stepper';
import _ from 'lodash';

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
                    },
                    validation: {
                        required: true,
                        word: true
                      },
                      valid: 0
                },
                lastName: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('lastName')
                    },
                    validation: {
                        required: true,
                        word: true
                      },
                      valid: 0
                },
                username: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('username')
                    },
                    validation: {
                        required: true,
                        username: true
                      },
                      valid: 0
                },
                email: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('email')
                    },
                    validation: {
                        required: true,
                        email: true
                      },
                      valid: 0
                },
                phoneNumber: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('phoneNumber')
                    },
                    validation: {
                        required: true,
                        phonenber: true
                      },
                      valid: 0
                },
                gender: {
                    value: "",
                    elType: 'select',
                    elementConfig: {
                        ...InputInfo('gender')
                    },
                    validation: {
                        required: true
                      },
                      valid: 1
                },
                password: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('password')
                    },
                    validation: {
                        required: true,
                        password: true
                      },
                      valid: 0
                }
            },
            Guest_house: {
                name: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('name')
                    },
                    validation: {
                        required: true,
                        spaceword: true
                      },
                      valid: 0
                },
                slogan: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('slogan')
                    },
                    validation: {
                        required: true,
                        spaceword: true
                      },
                      valid: 0
                },
                city: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('city')
                    },
                    validation: {
                        required: true,
                        word: true
                      },
                      valid: 0
                },
                sector: {
                    value: "",
                    elType: 'input',
                    elementConfig: {
                        ...InputInfo('sector')
                    },
                    validation: {
                        required: true,
                        word: true
                      },
                      valid: 0
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
                valid: this.checkIfValid(e.target.value, this.state.signup[this.state.currentStep][name].validation)
            }
          } 
        }
        //this.setState({
        //    isValid : this.checkIfValid(e.target.value, this.state.signup[this.state.currentStep][name].validation)
        //})
        this.setState({
            signup: field
        });
      }

      checkIfValid(field, rules) {
        let val = true;
        if (rules.required) {
          val = field.trim() !== "";
        }
        if (rules.word) {
            const pattern = /^([a-zA-Z]{3,})+$/;
          val = pattern.test(field);
        }
        if (rules.username) {
            const pattern = /^([a-zA-Z0-9@_.-]{3,})+$/;
          val = pattern.test(field);
        }
        if (rules.phonenber) {
            const pattern = /^([0-9]{9,})+$/;
          val = pattern.test(field);
        }
        if (rules.password) {
            const pattern = /^(?=.*[a-z])(?=.*\d)[A-Za-z\d@$!%*?&]{6,16}$/;
          val = pattern.test(field);
        }
        if (rules.spaceword) {
            const pattern = /^([a-zA-Z ]{3,})+$/;
          val = pattern.test(field);
        }
        if (rules.email) {
          const pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
          val = pattern.test(field);
        }
        return val ? 1 : 0;
      }

    render() {
        const {currentStep, signup, stepper} = this.state;
        let isValid = currentStep !== 'Submission' && Object.keys(signup[currentStep])
      .filter(key => signup[currentStep][key].valid === 1).length;
        const formArray = [];
        const initArr = _.omit(signup[currentStep], ['isValid']);
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
                button = <Button btnType="button" id={this.state.currentStep} text="Next" stepHandler={() => this.stepHandler('next')} disable={isValid !== Object.keys(signup[currentStep]).length && true}/>
                break;
            case 'Guest_house':
                button = (
                    <Fragment>
                    <Button btnType="button" id={this.state.currentStep} text="Back" stepHandler={() => this.stepHandler('prev')}/>
                    <Button btnType="button" id={this.state.currentStep} text="Next" stepHandler={() => this.stepHandler('next')} disable={isValid !== Object.keys(signup[currentStep]).length && true}/>
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

