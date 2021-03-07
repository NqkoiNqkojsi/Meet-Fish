<style>
* {box-sizing: border-box}

/* Full-width input fields */
  input[type=text], input[type=password], textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 0 0;
  display: inline-block;
  border: none;
  background: grey;
  border: 3px solid #ccc;
}

label {
    margin: 22px 0 0 0;
}

input[type=text]:focus, input[type=password]:focus, textarea:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
	span.psw {
    display: block;
    float: none;
  }
  .cancelbtn, .signupbtn {
    width: 100%;
  }
}

.column {
  float: left;
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}
.HiddObj{
    padding: 10px 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    background-color: #3AAFA9;
    display:none;
}
</style>