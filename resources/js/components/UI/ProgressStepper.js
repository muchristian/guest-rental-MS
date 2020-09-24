import React from 'react';

function ProgressStepper(props) {
	return (
		<li id={props.step.id} className={props.step.active ? 'active': null}><strong>{props.step.id.replace(/[_]/, " ")}</strong></li>
	);

}

export default ProgressStepper;