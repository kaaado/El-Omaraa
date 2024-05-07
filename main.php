<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>El Omaraa clinic</title> 
    <link rel="stylesheet" href="bbbb.CSS">
    <link rel="icon" href="img/clinic.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-EXAMPLE" crossorigin="anonymous" />

    <style>
.card-text {
    display: none;
    margin-bottom:10px;
    transition: display 0.3s ease;
}
.card.blur {
    filter: blur(8px);
    transition: filter 0.3s ease;
}

.card.expanded .card-text {
    display: block;
}
.card.scale-down {
    transform: scale(0.65);
}
.card:nth-child(2) h3{
margin-bottom:34px;
}
    </style>
<body> 
    <header> 

        <a href="#" class="logo">nawi-med</a> 
        <ul class="main"> 
            <li><a href="#hero">Home</a></li> 
            <li><a href="#service">Services</a></li> 
            <li><a href="#team">Team</a></li> 
            <li><a href="contact.php"id="contact-link">contact</a></li> 
             <li><a href="#book">book appointment</a></li> 
               
        </ul> 
        <!-- Fermez la balise ul ici --> 
     <?php
        session_start();
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            echo '<a href="dist/logout.php" class="number"><p>Logout</p></a>';
        } else {
            echo '<a href="dist/index.php" class="number"><p>Login</p></a>';
        }
        ?>
    </header> 
        <section id="hero"> 
            <div class="left">       
                <h1>Nawi-Med welcomes you.</span></h1>  
            </div> 
            <p>       
    Private non-hospital health establishment specializing in ophthalmology and ENT medicine and surgery. 
    <br>The clinic offers you a complete package 
    Medical services for the safety of your physical health<br> 
    with the best equipment available regarding our services. Your health is our responsibility. 
                </p> 
                <div class="social_icons"> 
                <a href="https://www.facebook.com/clinique.el.omaraa"><i style="font-size:20px" class="fab fa-facebook"></i></a> 
                <div id="phoneButton" class="number" onclick="showPhoneNumber()">
                    <i class="fas fa-phone"></i>
                    <p id="phoneButtonP" style="display: none;">0773996741</p> 
                  </div>
                  
                <a href="https://web.telegram.org"><i style="font-size:20px" class="fab fa-telegram"></i></a></div> 
       
            </div> 
            <div class="image-bg"><img src="img/clinic.jpg" alt="Service 1"></div>
    </section > 

    <h1 class="title-table">Services</h1> 

   <section id="service"><div class="container"> 
    <div class="card-container">
        <div class="card">
            <div class="card-content">
                <div class="card-image">
                    <img src="img/Optometry.jpg" alt="Service 1">
                </div>
                 <h3 class="title ">Optometry</h3>
                <div class="card-text">
                
                <div class="card-list ">
                    <p>REFRACTION ET CONTACTOLOGY</p> 
                    <ul><b>adaptation des:</b>
                        <li>SOFT LENSES</li>
                        <li>BOGICE LENTILS</li>
                        <li>MINI-SCLERAL LENSES</li>
                        <li>SCLERAL LENSES</li>
                    </ul>
                </div>
                </div>
                <button class="read-more">Read More</button>
            </div> 
        </div>

        <div class="card"> 
            <div class="card-content">
                <div class="card-image">
                    <img src="img/Surgery.jpg" alt="Service 2">
                </div>
                 <h3 class="title ">Medicine and Surgery of the Nose, Throat, and Ear</h3> 
                <div class="card-text">
                
                <div class="card-list">
                    <ul>
                    <li>OTO-ENDOSCOPY</li> 
                        <li>ENDOSCOPY OF</li>
                        <li>FALSE NASAL</li>
                        <li>RADIO FREQUENCY</li>
                    </ul>
                </div>
            </div>
                <button class="read-more">Read More</button>
            </div> 
        </div> 

        <div class="card"> 
            <div class="card-content">
                <div class="card-image">
                    <img src="img/Request.jpg" alt="Service 3">
                </div> 
                
                <h3 class="title">Request Anesthesia and Resuscitation</h3> 
                <div class="card-text">
                <div class="card-list ">
                    <ul><li>PRE-OPERATIVE ASSESSMENT</li> 
                        <li>HOSPITAL OF THE DAY GENERAL</li>
                        <li>MEDECINE CONSULTATION</li>
                    </ul>
                </div>
            </div>
                <button class="read-more">Read More</button>
            </div> 
        </div> 

        <div class="card"> 
            <div class="card-content">
                <div class="card-image">
                    <img src="img/Ophthalmology.jpg" alt="Service 4">
                </div> 
               
                <h3 class="title ">Ophthalmology</h3> 
                <div class="card-text">
                <div class="card-list ">
                    <ul><li>LASER ARGON</li> 
                        <li>RETINAL ANGIOGRAPHY</li>
                        <li>CORNEAL TOPOGRAPHY</li>
                        <li>OCT(MACULAR PAPILLARY ANTERIOR SEGMENT)</li>
                        <li>"A" AND "E" ULTRASOUND</li>
                        <li>PACHYMETRIE</li>
                    </ul>
                </div>
            </div>
                <button class="read-more">Read More</button>
            </div> 
        </div> 
    </div> 
</div>
</section>
<h1 class="title-table">Team</h1> 
    <section id="team"> 
        <div class="container-doc">
             <div class="left-div">
            <div class="photo"> 
                <img src="img/doctor1.jpg" alt="Photo"> 
            </div> 
            <div class="stars-in-right"> 
            <i class="fas fa-star" data-value="1"></i>
            <i class="fas fa-star" data-value="2"></i>
            <i class="fas fa-star" data-value="3"></i>
            <i class="fas fa-star" data-value="4"></i>
            <i class="fas fa-star" data-value="5"></i>
            </div></div>
            <div class="application"> 
                <h2>Dr. Khouane.S.M</h2> 
                <p><b>Specialty:</b> Optometry</p> 
                <p><b>Experience:</b> 15 years</p> 
                <p><b>Education:</b> medecin</p> 
            </div> 
        </div> 
        <div class="container-doc"> 
            <div class="left-div">
                <div class="photo"> 
                    <img src="img/doctor2.jpg" alt="Photo"> 
                </div> 
                <div class="stars-in-right"> 
                <i class="fas fa-star" data-value="1"></i>
                <i class="fas fa-star" data-value="2"></i>
                <i class="fas fa-star" data-value="3"></i>
                <i class="fas fa-star" data-value="4"></i>
                <i class="fas fa-star" data-value="5"></i>
                </div></div>
            <div class="application"> 
                <h2>Dr.Salhi .O</h2> 
                <p><b>Specialty:</b> Optometry</p> 
                <p><b>Experience:</b> 12 years</p> 
                <p><b>Education:</b> medecin</p> 
            </div> 
        </div> 
    <div class="container-doc"> 
        <div class="left-div">
            <div class="photo"> 
                <img src="img/doctor3.jpg" alt="Photo"> 
            </div> 
            <div class="stars-in-right"> 
            <i class="fas fa-star" data-value="1"></i>
            <i class="fas fa-star" data-value="2"></i>
            <i class="fas fa-star" data-value="3"></i>
            <i class="fas fa-star" data-value="4"></i>
            <i class="fas fa-star" data-value="5"></i>
            </div></div>
        <div class="application"> 
            <h2>Dr. Abdallah.A.O</h2> 
            <p><b>Specialty:</b>Medecine and surgerynof the nose throat and ear </p> 
            <p><b>Experience:</b> 20 years</p> 
             <p><b>Education:</b> medecin</p> 
        </div> 
    </div> 
    <div class="container-doc"> 
        <div class="left-div">
            <div class="photo"> 
                <img src="img/doctor4.jpg" alt="Photo"> 
            </div> 
            <div class="stars-in-right"> 
            <i class="fas fa-star" data-value="1"></i>
            <i class="fas fa-star" data-value="2"></i>
            <i class="fas fa-star" data-value="3"></i>
            <i class="fas fa-star" data-value="4"></i>
            <i class="fas fa-star" data-value="5"></i>
            </div></div>
        <div class="application"> 
            <h2>Dr. Souag .M </h2> 
            <p><b>Specialty:</b> Request anesthesia and resuscitation</p> 
            <p><b>Experience:</b> 10 years</p> 
             <p><b>Education:</b> medecin</p> 
        </div> 
    </div> 
    <div class="container-doc"> 
        <div class="left-div">
            <div class="photo"> 
                <img src="img/doctor5.jpg" alt="Photo"> 
            </div> 
            <div class="stars-in-right"> 
            <i class="fas fa-star" data-value="1"></i>
            <i class="fas fa-star" data-value="2"></i>
            <i class="fas fa-star" data-value="3"></i>
            <i class="fas fa-star" data-value="4"></i>
            <i class="fas fa-star" data-value="5"></i>
            </div></div>
        <div class="application"> 
            <h2> Dr. Khouane .L </h2> 
            <p><b>Specialty:</b> optometry</p> 
            <p><b>Experience:</b> 7 years</p> 
             <p><b>Education:</b> medecin</p> 
        </div> 
    </div> 
    </section> 
    <section id="book"> 
        <h1 class="title-table">Opening Hours</h1>
        <table>
            <tr>
                <th>Day of the Week</th>
                <th>Opening Time</th>
                <th>Closing Time</th>
            </tr>
            <tr>
                <td>Sunday</td>
                <td>08:00 AM</td>
                <td>06:00 PM</td>
            </tr>
            <tr>
                <td>Monday</td>
                <td>08:00 AM</td>
                <td>06:00 PM</td>
            </tr>
            <tr>
                <td>Tuesday</td>
                <td>08:00 AM</td>
                <td>06:00 PM</td>
            </tr>
            <tr>
                <td>Wednesday</td>
                <td>08:00 AM</td>
                <td>06:00 PM</td>
            </tr>
            <tr>
                <td>Thursday</td>
                <td>08:00 AM</td>
                <td>06:00 PM</td>
            </tr>
            <tr>
                <td>Friday</td>
                <td>Closed</td>
                <td>Closed</td>
            </tr>
            <tr>
                <td>Saturday</td>
                <td>09:00 AM</td>
                <td>01:00 PM</td>
            </tr>
        </table>
        
       
</section> 
     
<footer class="footer"> 
    <p class="footer_title">&copy; 2024 Al omaraa</p> 
</footer> 
</body> 
<script>
     // Smooth scrolling functionality
     document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                const margin = 130;

                window.scrollTo({
                    top: target.offsetTop - margin,
                    behavior: 'smooth'
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
    const containerDocs = document.querySelectorAll('.container-doc');

    containerDocs.forEach(containerDoc => {
        const stars = containerDoc.querySelectorAll('.fa-star');
        const doctorName = containerDoc.querySelector('h2').textContent;

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');

                // Toggle active class for the clicked star and remove it from all other stars
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });

                // Save the rating value to local storage with doctor's name as the key
                localStorage.setItem(doctorName, value);
            });
        });

        // Load user's rating from local storage
        const userRating = localStorage.getItem(doctorName);
        if (userRating) {
            // Apply the stored rating by adding 'active' class to stars up to the stored value
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= userRating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }
    });
});


    // Add an event listener to the Contact link
    document.getElementById('contact-link').addEventListener('click', function(event) {
            // Prevent the default action of following the link
            event.preventDefault();
            // Calculate the center position of the screen
            var leftPosition = (screen.width - 950) / 2;
            var topPosition = (screen.height - 550) / 2;
            // Open a new browser window in the center of the screen
            var newWindow = window.open('contact.php', '_blank', 'width=950,height=550,left=' + leftPosition + ',top=' + topPosition);
        });

        function showPhoneNumber() {
  var button = document.getElementById("phoneButton");
  var isActive = button.classList.contains("number");
  var phoneP = document.getElementById("phoneButtonP");

  if (isActive) {
    button.classList.remove("number");
    phoneP.style.display = "none";
  } else {
    button.classList.add("number");
    phoneP.style.display = "inline";
  }
}   

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        const readMoreBtn = card.querySelector('.read-more');
        const cardText = card.querySelector('.card-text');

        readMoreBtn.addEventListener('click', function() {
            // Toggle display of card text
            const isExpanded = card.classList.toggle('expanded');
            cardText.style.display = isExpanded ? 'block' : 'none';

            // Toggle text content of "Read More" button
            readMoreBtn.textContent = isExpanded ? 'Show Less' : 'Read More';

            // Toggle blur and pointer-events on other cards
            cards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.toggle('blur', isExpanded);
                    const otherReadMoreBtn = otherCard.querySelector('.read-more');
                    otherReadMoreBtn.style.pointerEvents = isExpanded ? 'none' : 'auto';
                }
            });
        });
    });
});







</script>
</html>




	
