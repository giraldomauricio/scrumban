/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function validateGirlForm(form)
{
  var err = "";
  
  if(form.artistic_name.value == "") err += "Please type the artisitc name.<br />";
  if(form.real_name.value == "") err += "Please type the real name.<br />";
  if(form.height.value == "") err += "Please type the height.<br />";
  if(form.weight.value == "") err += "Please type the weight.<br />";
  if(form.age.value == "") err += "Please type the age.<br />";
  
  if(err != "")
  {
    document.getElementById("alertDialog").innerHTML = err;
    document.getElementById("myModalLabel").innerHTML = "Girl information incomplete";
    $('#alertModal').modal('show');
    return false;
  }
  else return true;
}

function validateCityForm(form)
{
  var err = "";
  
  if(form.city_name.value == "") err += "Please type the city name.<br />";
  
  if(err != "")
  {
    document.getElementById("alertDialog").innerHTML = err;
    document.getElementById("myModalLabel").innerHTML = "City information incomplete";
    $('#alertModal').modal('show');
    return false;
  }
  else return true;
}