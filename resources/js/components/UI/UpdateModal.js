import React, { Component, Fragment } from 'react';
import Form from '../UI/Form';
import Button from '../UI/Button';
import InputInfo from '../../utils/InputInfo';
import Overlay from './Overlay';

export default class UpdateModal extends Component {
    state = {
        update: {
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
        mode: 'show-modal'
    }

    openModal = () => {
        this.setState({
          mode: 'show-modal'  
        })        
    }

    closeModal = () => {
        this.setState({
          mode: 'hide-modal'  
        })        
    }

    componentDidMount() {
        this.props.show ? this.openModal() : this.closeModal()
    }
    componentDidUpdate(prevProps) {
        if (prevProps.show !== this.props.show) {
            this.props.show ? this.openModal() : this.closeModal()
        }
    }
    render() {
        let formArray = [];
        for (let key in this.state.update) {
            formArray.push({
                id: key,
                config: this.state.update[key]
            });
        }
        let formElement = (
          <form className="p-4 d-flex flex-column justify-content-between">
              <span className="ml-auto close-btn ti-close" onClick={() => this.closeModal()}></span>
                          <div className="row">
              {formArray.map(el => (
                  <div key={el.id} className={"col-6 col-sm-6 col-md-6 col-lg-6 pl-0" + " " + el.config.elementConfig.class}>
                  <Form
                      elementType={el.config.elType}
                      elementConfig={el.config.elementConfig}
                      value={el.config.value}
                  ></Form>
                  </div>
              ))}
              </div>
              <div className="mt-1 pl-2 pr-2">
                  <Button btnType="button" text="Update"/></div>
          </form>
      );
        return (
            <Fragment>
            <Overlay class={this.state.mode}/>
            <div className={"update-card-modal" + ' ' + this.state.mode}>
                {formElement}
            </div>
            </Fragment>
        )
    }
}