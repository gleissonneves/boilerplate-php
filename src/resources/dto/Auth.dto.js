class AuthDTO {
  constructor(username, password) {
    this.username = username;
    this.password = password;
  }

  validate() {
    const errors = [];
    if (!this.username || typeof this.username !== 'string') {
      errors.push('Invalid or missing username');
    }
    if (!this.password || typeof this.password !== 'string') {
      errors.push('Invalid or missing password');
    }
    return errors;
  }
}