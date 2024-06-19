/**
 * @var regexSequenciaCNPJInvalid
 * @description ExpressÃ£o regular para detectar sequÃªncias invÃ¡lidas de 14 dÃ­gitos em nÃºmeros de CNPJ.
 *              Exemplo de uso: regexSequenciaCNPJInvalid.test('00000000000000'); // true
 */
const regexSequenciaCNPJInvalid =
  /(0{14})|(1{14})|(2{14})|(3{14})|(4{14})|(5{14})|(6{14})|(7{14})|(8{14})|(9{14})/;


const isValidCNPJ = (cnpj) => {
  const digitos = cnpj.replace(/\D/g, '');

  if (digitos.length === 0) {
    return {
      message: 'CNPJ inválido!',
      status: true,
    };
  }

  if (digitos.length !== 14 || _isInvalidCNPJ(digitos)) {
    return {
      message: 'CNPJ inválido!',
      status: true,
    };
  }

  const numberOfDigitsToValidate = 2;
  const numberOfDigitsToCalculate = digitos.length - numberOfDigitsToValidate;

  const digitsToValidade = digitos.substring(numberOfDigitsToCalculate);
  const digitsToCalculate = digitos.substring(
    0,
    numberOfDigitsToCalculate
  );

  const firstDigitValidatedCnpj = digitos.substring(
    0,
    numberOfDigitsToCalculate + 1
  );

  const firstDigitToValidate = parseInt(digitsToValidade.charAt(0));
  const secondDigitToValidate = parseInt(digitsToValidade.charAt(1));

  const digitsToCalculateArray = digitsToCalculate
    .split('')
    .map((digit) => parseInt(digit));

  const firstDigitValidatedArray = firstDigitValidatedCnpj
    .split('')
    .map((digit) => parseInt(digit));


  if(!(
    _isValidateCnpjDigit(
      digitsToCalculateArray, numberOfDigitsToCalculate, firstDigitToValidate
    ) &&
    _isValidateCnpjDigit(
      firstDigitValidatedArray,
      numberOfDigitsToCalculate + 1,
      secondDigitToValidate
    )
  )) {
    return {
      message: 'CNPJ inválido!',
      status: true,
    };
  }
};

function _isValidateCnpjDigit(
  numbers,
  lenght,
  digit
) {
  let factor = lenght - 7;
  const sumValue = 0;

  const sum = numbers.reduce((total, amount) => {
    const result = total + amount * factor--;

    if (factor < 2) factor = 9;

    return result;
  }, sumValue);

  const result = sum % 11 < 2 ? 0 : 11 - (sum % 11);

  if (result != digit) return false;

  return true;
}

function _isInvalidCNPJ(value) {
  return regexSequenciaCNPJInvalid.test(value);
}
