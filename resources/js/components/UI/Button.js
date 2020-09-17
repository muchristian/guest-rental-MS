import React from 'react';

const Button = (props) => {
    return (
    <button type={props.btnType} action={props.text} className="btn btn-lg">{props.text}</button>
    )
}

export default Button;
