class VerificaCPF {
  constructor(cpf) {
    this.cpf = cpf;
  }

  limpaCPF(cpfSujo = this.cpf) {
    const regex = /^(\d{3})[\s-.]?(\d{3})[\s-.]?(\d{3})[\s-.]?(\d{2})$/;
    const cpfLimpo = cpfSujo.replace(regex, "$1$2$3$4");
    const cpfRepetido = cpfLimpo[0].padStart(11, cpfLimpo[0]);

    if (cpfLimpo.length === 11 && cpfLimpo !== cpfRepetido) return cpfLimpo;
    else return false;
  }

  static verificaCPF(cpfSoma, cpf, index) {
    const operacao = 11 - (cpfSoma % 11);
    return operacao >= 10 ? 0 === +cpf[index] : operacao === +cpf[index];
  }

  validaDigito(verificacao, cpfLimpo) {
    let cpfSoma = 0;
    let j = 0;
    let multiplicador = verificacao === 1 ? 10 : 11;
    const index = verificacao === 1 ? 9 : 10;

    if (!cpfLimpo) return;

    for (multiplicador; multiplicador >= 2; multiplicador--) {
      cpfSoma += +cpfLimpo[j] * multiplicador;
      j++;
    }
    return VerificaCPF.verificaCPF(cpfSoma, cpfLimpo, index);
  }

  init() {
    const cpfLimpo = this.limpaCPF();
    const verificacao1 = this.validaDigito(1, cpfLimpo);
    const verificacao2 = this.validaDigito(0, cpfLimpo);

    if (verificacao1 && verificacao2) {
      console.log("CPF Válido");
      return true;
    } else {
      console.log("CPF Inválido");
      return false;
    }
  }
}
