<style>
.body{
  font-family: Arial, Helvetica, sans-serif;
  position:relative;
  background-color:#f4f1de;
  margin: auto;
  text-align: center;
}

/* Navbar container */
.navbar {
  width: 100%;
  background-color: #81b29a;
  overflow: visible;
  z-index:90;
  display: flex;             /* NEW, Spec - Opera 12.1, Firefox 20+ */
  max-height: 15%;
  color:#f2cc8f;
}

/* Navbar links */
.navbar a {
  float: left;
  text-align: center;
  padding: 14px;
  color: #f2cc8f;
  text-decoration: none;
  font-size: 18px;
   min-width: 0;
   min-height: 0;
}

/* Navbar links on mouse-over */
.navbar a:hover {
  background-color: #e07a5f;
  color: black;
}

/* Current/active navbar link */
.active {
  background-color: #4CAF50;
}

/* Add responsiveness - will automatically display the navbar vertically instead of horizontally on screens less than 500 pixels */
@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}
/* The dropdown container */
.dropbtn {
  background-color: #81b29a;
  color: #f2cc8f;
  padding: 14px;
  font-size: 18px;
  border: none;
  cursor: pointer;
  height:100%;
  z-index:99;
  max-height: 60px;
  position: relative;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #3AAFA9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
  z-index:99;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 99;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
/* Footer */
.footer{
  width: 100%;
  background-color: #DEF2F1;
  overflow: visible;
  z-index:90;
  max-height: 15%; 
  position: absolute;
  margin-top: 15px;
  bottom: 0;
}
</style>