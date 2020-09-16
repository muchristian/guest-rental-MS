import React, {Fragment} from 'react';

const Form = (props) => {
    let inputElement = null;
    switch(props.elementType) {
        case 'input':
            inputElement = (<Fragment>
      <input  {...props.elementConfig}  onChange={props.inputHandler} id={props.elementConfig.label} value={props.value} className="form-control"/>
      <label className={props.elementConfig.label}>{props.elementConfig.label}</label></Fragment>);
        break;
        case 'select':
        inputElement = (
            <select {...props.elementConfig} class="selectpicker form-control">
            {props.elementConfig.options.map(option => (
                <option key={option}>{option}</option>
            ))}
            </select>
            )
        break;
        default:
            inputElement = <input {...props.elementConfig} value={props.value} className="form-control"/>

    }
    return (
        inputElement      
    )
}

export default Form;