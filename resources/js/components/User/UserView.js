import React, { Component, Fragment } from 'react';
import DashLayout from '../DashLayout';
import Form from '../UI/Form';
import Button from '../UI/Button';

class UserView extends Component {
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
                options: ['male', 'female'],
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
render() {
  let formArray = [];
        for (let key in this.state.signup) {
            formArray.push({
                id: key,
                config: this.state.signup[key]
            });
        }
        let formElement = (
          <form className="ml-3 p-4">
              
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
              <div className="mt-1 pl-2 pr-2"><Button btnType="button" text="Signup"/></div>
          </form>
      );
    return (
<DashLayout>
            <div className="row">
            <div class="card profile-card col-xl-3 col-lg-4 col-md-5 mb-4">
                <div class="d-flex justify-content-center">
                <div class="profile"><span>MC</span></div>
                </div>
  <div class="card-body pt-0 pb-2">
    <h2>Username</h2>
    <p className="p-name">full name</p>
    <div className="row">
      <p className="col-xl-5 col-lg-5 col-5">role: Admin</p>
      <p className="col-xl-5 col-lg-5 col-5">
        <span className="fa fa-home"></span> b-way</p>
      <p className="col-xl-5 col-lg-5 col-5">
        <span className="fa fa-clock-o" aria-hidden="true"></span> 2020-03-07</p>
    </div>
    <div className="profile-social mt-3 mb-3 d-flex justify-content-center">
      <span className="fa fa-phone" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="top" data-content="+250723728660"></span>
      <span className="fa fa-envelope" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="top" data-content="admin@mail.com"></span>
    </div>
  </div>
</div>
<div className="update-card col-xl-9 col-lg-8 col-md-7 pr-0 mb-4">
{formElement}
</div>
</div>
</DashLayout>
    )
}
}

export default UserView;