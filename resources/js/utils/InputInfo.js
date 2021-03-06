
function InputInfo(key) {
    switch(key) {
        case 'firstName':
            return {
                type: "text",
                    placeholder: "Mark",
                    name: "firstName",
                    label: "First name",
                    class: "form-group has-float-label"
            }
        case 'lastName':
            return {
                type: "text",
                    placeholder: "Joe",
                    name: "lastName",
                    label: "Last name",
                    class: "form-group has-float-label"
            }
        case 'email':
            return {
                type: "email",
                    placeholder: "markjoe213@mail.com",
                    name: "email",
                    label: "Email",
                    class: "form-group has-float-label"
            }
        case 'username':
            return {
                type: "text",
                    placeholder: "markJ@21",
                    name: "username",
                    label: "Username",
                    class: "form-group has-float-label"
            }
        case 'phoneNumber':
            return {
                type: "text",
                    placeholder: "07********",
                    name: "phoneNumber",
                    label: "Phone number",
                    class: "form-group has-float-label"
            }
        case 'gender': 
            return {
                type: "select",
                    options: [{ value: 'male', label: 'male' },
                    { value: 'female', label: 'female' }],
                    class: "form-group"
            }
        case 'password':
            return {
                type: "password",
                    placeholder: "markJoe@213",
                    name: "password",
                    label: "Password",
                    class: "form-group has-float-label"
            }
            case 'name':
                return {
                    type: "text",
                        placeholder: "Gueplace",
                        name: "name",
                        label: "Name",
                        class: "form-group has-float-label"
                }
                case 'slogan':
            return {
                type: "text",
                    placeholder: "Better service first",
                    name: "slogan",
                    label: "Slogan",
                    class: "form-group has-float-label"
            }
            case 'city':
            return {
                type: "text",
                    placeholder: "Kigali",
                    name: "city",
                    label: "City",
                    class: "form-group has-float-label"
            }
            case 'sector':
            return {
                type: "text",
                    placeholder: "Kicukiro",
                    name: "sector",
                    label: "Sector",
                    class: "form-group has-float-label"
            }
    }

}

export default InputInfo;
