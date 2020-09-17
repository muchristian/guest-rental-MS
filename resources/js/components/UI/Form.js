import React, {Fragment} from 'react';
import Select from 'react-select';

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
            <Select 
            defaultValue={props.elementConfig.options[0]}
            options={props.elementConfig.options}/>
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