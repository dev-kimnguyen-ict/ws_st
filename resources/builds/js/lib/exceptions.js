class ValidationException extends Error {
    constructor (errors) {
        super('Validation error')
        this.errors = errors
    }
}

class AuthenticationException extends Error {
    constructor () {
        super('Authentication error')
    }
}

export {
    ValidationException,
    AuthenticationException,
}
