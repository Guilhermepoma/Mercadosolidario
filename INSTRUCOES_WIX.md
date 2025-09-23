# Instruções para Integração com Wix

## Substituição do PHP por Soluções Compatíveis com Wix

Como o Wix não suporta PHP diretamente, criamos 3 alternativas para o formulário de contato funcionar perfeitamente:

## 🎯 OPÇÃO 1: EmailJS (Recomendado - Mais Simples)

### Configuração:
1. **Criar conta no EmailJS:**
   - Acesse: https://emailjs.com
   - Crie uma conta gratuita
   - Conecte seu email (Gmail, Outlook, etc.)

2. **Configurar Serviço:**
   - Vá em "Email Services"
   - Adicione Gmail ou outro provedor
   - Anote o `Service ID`

3. **Criar Template:**
   - Vá em "Email Templates"
   - Crie um novo template com estas variáveis:
     ```
     Nome: {{from_name}}
     Email: {{from_email}}
     Telefone: {{phone}}
     Assunto: {{subject}}
     Mensagem: {{message}}
     ```
   - Anote o `Template ID`

4. **Obter Chave Pública:**
   - Vá em "Account" > "General"
   - Copie a `Public Key`

5. **Atualizar o código:**
   - No arquivo `contato.html`, linha 245:
     ```javascript
     emailjs.init("SUA_PUBLIC_KEY_AQUI");
     ```
   - Nas linhas 275-285, descomente e configure:
     ```javascript
     emailjs.send('SEU_SERVICE_ID', 'SEU_TEMPLATE_ID', templateParams)
     ```

### Vantagens:
- ✅ Funciona 100% no Wix
- ✅ Gratuito até 200 emails/mês
- ✅ Fácil configuração
- ✅ Emails chegam diretamente na caixa de entrada

---

## 🎯 OPÇÃO 2: Wix Corvid/Velo (Avançado)

### Configuração:
1. **Ativar Velo no Wix:**
   - No Editor Wix, clique em "Dev Mode"
   - Ative o Velo (antigo Corvid)

2. **Criar Banco de Dados:**
   - Vá em "Database" > "New Collection"
   - Nome: "Contatos"
   - Campos:
     - nome (Text)
     - email (Text)
     - telefone (Text)
     - assunto (Text)
     - mensagem (Text)
     - data (Date)

3. **Código Backend (backend/events.js):**
   ```javascript
   import { save } from 'wix-data';
   import { emailSupport } from 'wix-crm-backend';

   export function salvarContato(dados) {
     return save('Contatos', dados)
       .then(() => {
         return emailSupport.emailContact({
           emailId: 'template_id',
           toEmail: 'guilhermepomacercena@gmail.com',
           variables: dados
         });
       });
   }
   ```

4. **Código Frontend (página):**
   ```javascript
   import { salvarContato } from 'backend/events';

   $w('#contatoForm').onSubmit(() => {
     const dados = {
       nome: $w('#nome').value,
       email: $w('#email').value,
       // ... outros campos
     };
     
     salvarContato(dados)
       .then(() => {
         $w('#mensagemStatus').text = 'Mensagem enviada!';
       });
   });
   ```

### Vantagens:
- ✅ Integração nativa com Wix
- ✅ Banco de dados próprio
- ✅ Controle total dos dados
- ✅ Notificações automáticas

---

## 🎯 OPÇÃO 3: Wix Forms Nativo (Mais Simples)

### Configuração:
1. **Usar Wix Forms:**
   - No Editor Wix, adicione elemento "Contact Form"
   - Configure os campos necessários
   - Mantenha apenas o CSS desta página para o design

2. **Configurar Notificações:**
   - Vá em "Settings" > "Forms"
   - Configure email de notificação
   - Personalize mensagens automáticas

### Vantagens:
- ✅ Zero código necessário
- ✅ Configuração visual
- ✅ Integração automática com CRM Wix
- ✅ Proteção anti-spam

---

## 📱 Configuração do WhatsApp

Para o botão do WhatsApp funcionar:

1. **Substitua o número:**
   - Linha 47 e outras: `https://wa.me/5548999999999`
   - Formato: `55` + `DDD` + `número` (sem espaços)
   - Exemplo: `https://wa.me/5548999887766`

2. **Mensagem pré-definida (opcional):**
   ```
   https://wa.me/5548999887766?text=Olá! Gostaria de saber mais sobre o Mercado Solidário.
   ```

---

## 🎨 Responsividade Mobile

O novo design já está otimizado para mobile com:

- ✅ Layout responsivo
- ✅ Botões touch-friendly
- ✅ Formulário adaptável
- ✅ Navegação mobile
- ✅ Imagens otimizadas

### Principais melhorias:
- Grid flexível que se adapta a qualquer tela
- Botões maiores para touch
- Texto legível em dispositivos pequenos
- Carrossel otimizado para swipe
- Menu de navegação responsivo

---

## 🚀 Próximos Passos

1. **Escolha uma das 3 opções acima**
2. **Configure conforme as instruções**
3. **Teste o formulário**
4. **Atualize o número do WhatsApp**
5. **Publique no Wix**

---

## 📞 Suporte

Se precisar de ajuda com a implementação:
- Documentação EmailJS: https://emailjs.com/docs/
- Documentação Wix Velo: https://dev.wix.com/docs/
- Suporte Wix: https://support.wix.com/

---

**Nota:** O EmailJS (Opção 1) é a mais recomendada por ser simples, confiável e funcionar perfeitamente com Wix sem necessidade de conhecimento técnico avançado.

