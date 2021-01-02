class Validation
{constructor(formId)
{this.form=$("#"+formId);this.submitButton=$(this.form).find('input[type="submit"]');this.submitButtonText=this.submitButton.val();this.inputLog=[];this.validC="is-valid";this.invalidC="is-invalid";this.checkAll();}
requireText(inputId,minLength,maxLength,illegalCharArray,necessaryCharArray)
{let input=$("#"+inputId);let invalidString="";this.createAsterisk(input);this.inputLog.push(["requireText",inputId,minLength,maxLength,illegalCharArray,necessaryCharArray]);$(input).on('input focus',input,()=>{invalidString="";invalidString+=this.lengthCheck(input,minLength,maxLength);invalidString+=this.illegalCharCheck(input,illegalCharArray);this.showWarning(input,inputId,invalidString);});$(input).on('input',input,()=>{this.submitDisabled(false,this.submitButtonText);});$(input).on('focusout',input,()=>{invalidString+=this.necessaryCharCheck(input,necessaryCharArray);this.showWarning(input,inputId,invalidString);this.removeValid(input);});return invalidString;}
requireEmail(inputId,minLength,maxLength,illegalCharArray,necessaryCharArray)
{let input=$("#"+inputId);let invalidString="";this.createAsterisk(input);this.inputLog.push(["requireEmail",inputId,minLength,maxLength,illegalCharArray,necessaryCharArray]);$(input).on('input focus',input,()=>{invalidString="";invalidString+=this.lengthCheck(input,minLength,maxLength);invalidString+=this.illegalCharCheck(input,illegalCharArray);this.showWarning(input,inputId,invalidString);});$(input).on('input',input,()=>{this.submitDisabled(false,this.submitButtonText);});$(input).on('focusout',input,()=>{invalidString+=this.necessaryCharCheck(input,necessaryCharArray);invalidString+=this.emailCheck(input);this.showWarning(input,inputId,invalidString);this.removeValid(input);});return invalidString;}
registerPassword(inputId,minLength,maxLength,illegalCharArray,necessaryCharArray,passConfirmId)
{let input=$("#"+inputId);let passConfirm=$("#"+passConfirmId);let invalidString="";let invalidCheckString="";this.createAsterisk(input);this.createAsterisk(passConfirm);this.inputLog.push(["registerPassword",inputId,minLength,maxLength,illegalCharArray,necessaryCharArray,passConfirmId]);$(input).on('input focus',input,()=>{invalidString="";invalidString+=this.lengthCheck(input,minLength,maxLength);invalidString+=this.illegalCharCheck(input,illegalCharArray);this.showWarning(input,inputId,invalidString);invalidCheckString="";invalidCheckString+=this.passwordMatchCheck(input,passConfirm);this.showWarning(passConfirm,passConfirmId,invalidCheckString);});$(input).on('input',input,()=>{this.submitDisabled(false,this.submitButtonText);});$(input).on('focusout',input,()=>{invalidString+=this.necessaryCharCheck(input,necessaryCharArray);invalidString+=this.capitalCheck(input);invalidString+=this.numberCheck(input);invalidString+=this.specialCharCheck(input);this.showWarning(input,inputId,invalidString);this.removeValid(input);this.removeValid(passConfirm);});$(passConfirm).on('input focus',passConfirm,()=>{invalidCheckString="";invalidCheckString+=this.passwordMatchCheck(input,passConfirm);this.showWarning(passConfirm,passConfirmId,invalidCheckString);});$(passConfirm).on('input',input,()=>{this.submitDisabled(false,this.submitButtonText);});$(passConfirm).on('focusout',passConfirm,()=>{this.removeValid(passConfirm);});return invalidString;}
lengthCheck(input,minLength,maxLength)
{if(input.val().length<=minLength)
{return "No debe contener mas de "+minLength+" caracteres. ";}
else if(input.val().length>=maxLength)
{return "No debe contener menos de "+maxLength+" caracteres. ";}
else
{return "";}}
illegalCharCheck(input,illegalCharArray)
{let illegalsUsed="";$(illegalCharArray).each(function()
{if(input.val().indexOf(this)>=0)
{if(!this.trim().length==0)
{illegalsUsed+=" "+this;}
else
{illegalsUsed+=" spaces"}}});if(illegalsUsed==="")
{return "";}
else
{return "Cannot use:"+illegalsUsed+". ";}}
necessaryCharCheck(input,necessaryCharArray)
{let notUsed="";$(necessaryCharArray).each(function()
{if(!(input.val().indexOf(this)>=0))
{notUsed+=" "+this;}});if(notUsed==="")
{return "";}
else
{return "Must contain:"+notUsed+". ";}}
numberCheck(input)
{if(!input.val().match(/\d/))
{return "Debe contener un nÃºmero. ";}
else
{return "";}}
specialCharCheck(input)
{if(!input.val().match(/\W|_/g))
{return "Debe contener un caracter especial. ";}
else
{return "";}}
capitalCheck(input)
{if(input.val().match(/[A-Z]+/))
{return "";}
else
{return "Debe contener mayÃºsculas. ";}}
passwordMatchCheck(input,passConfirm)
{if(input.val()===passConfirm.val())
{return "";}
else
{return "Las contraseÃ±as no coinciden. ";}}
emailCheck(input)
{if(input.val().match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/))
{return "";}
else
{return "No es un e-mail vÃ¡lido";}}
submitDisabled(trueFalse,value)
{$(this.submitButton).prop('disabled',trueFalse);$(this.submitButton).val(value);}
checkAll()
{$(this.form).submit((e)=>{$(this.inputLog).each((i)=>{let invalidString="";let invalidCheckString="";let thisLog=this.inputLog[i];let inputId=thisLog[1];let input=$("#"+inputId);let minLength=thisLog[2];let maxLength=thisLog[3];let illegalCharArray=thisLog[4];let necessaryCharArray=thisLog[5];if(thisLog[0]==="registerPassword")
{var passConfirmId=thisLog[6];var passConfirm=$("#"+passConfirmId);}
invalidString="";invalidString+=this.lengthCheck(input,minLength,maxLength);invalidString+=this.illegalCharCheck(input,illegalCharArray);invalidString+=this.necessaryCharCheck(input,necessaryCharArray);if(thisLog[0]==="requireEmail")
{invalidString+=this.emailCheck(input);}
if(thisLog[0]==="registerPassword")
{invalidString+=this.capitalCheck(input);invalidString+=this.numberCheck(input);invalidString+=this.specialCharCheck(input);invalidCheckString+=this.passwordMatchCheck(input,passConfirm);}
if(invalidString)
{this.showWarning(input,inputId,invalidString);this.submitDisabled(true,"Error, por favor revise su formulario");e.preventDefault();}
if(invalidCheckString)
{this.showWarning(passConfirm,passConfirmId,invalidCheckString);this.submitDisabled(true,"Error, por favor revise su formulario");e.preventDefault();}});});}
showWarning(input,inputId,invalidString)
{if(invalidString)
{this.generateFeedback(input,inputId,"invalid-feedback",invalidString);this.makeInvalid(input);}
else
{this.generateFeedback(input,inputId,"","");this.makeValid(input);}}
makeValid(element)
{if(!element.hasClass(this.validC))
{element.addClass(this.validC);}
if(element.hasClass(this.invalidC))
{element.removeClass(this.invalidC);}}
removeValid(element)
{if(element.hasClass(this.validC))
{element.removeClass(this.validC);}}
makeInvalid(element)
{if(!element.hasClass(this.invalidC))
{element.addClass(this.invalidC);}
if(element.hasClass(this.validC))
{element.removeClass(this.validC);}}
createAsterisk(input)
{$("<span class='text-danger'>*</span>").insertBefore(input)}
generateFeedback(input,inputId,validityClass,prompt)
{$('#'+inputId+'-feedback').remove();$('<div id="'+inputId+'-feedback" class="'+validityClass+'">'+prompt+'</div>').insertAfter(input);}}