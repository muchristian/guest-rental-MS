import React from 'react';

const Button = (props) => {
    return (
    <button type={props.btnType} action={props.text} onClick={props.stepHandler} className="btn btn-lg mr-3" disabled={props.disable}>{props.text}</button>
    )
}

export default Button;
