import React, { Component, Fragment } from "react";
import Form from "../UI/Form";
import Button from "../UI/Button";
import { Link } from "react-router-dom";
import ProgressStepper from "../UI/ProgressStepper";

export default class Stepper extends Component {
    state = {
        steps: [],
    };
    indexOfHandler(val) {
        return Object.keys(this.props.stepper).indexOf(val);
    }
    assignStepper() {
        let stepperArr = [];
        for (let key in this.props.stepper) {
            stepperArr.push({
                id: key,
                active: key === this.props.currentStep ? true : false,
                approval:
                    this.indexOfHandler(key) <
                        this.indexOfHandler(this.props.currentStep) &&
                    "approved",
            });
        }
        this.setState({ steps: stepperArr });
    }
    componentDidMount() {
        /*
          let obj = {
            ...this.props.signup[this.props.currentStep]
          }
          this.setState({sign: obj})
          */
        this.assignStepper();
    }
    componentDidUpdate(prevProps) {
        if (prevProps.currentStep !== this.props.currentStep) {
            this.assignStepper();
        }
    }
    render() {
        const { steps } = this.state;
        let formElement = (
            <Fragment>
                <ul id="progressStepper">
                    {steps.map((st) => (
                        <ProgressStepper key={st.id} step={st} />
                    ))}
                </ul>
            </Fragment>
        );
        return <Fragment>{formElement}</Fragment>;
    }
}
