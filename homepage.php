<!DOCTYPE html>
<html>
    <head>
        <title>Automated Scheduling System</title>
        <link rel="stylesheet" type="text/css" href="homepage.css">
    </head>
    <body>

        <header>
            <h1>Computer Studies Scheduling System </h1>
            <nav>
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="head_login.php">Department Head</a></li>
                    <li><a href="faculty_login.php">Faculty</a></li>
                    <li><a href="addmin_section.php">Create Account</a></li>
                </ul>
            </nav>    
        </header>
        <section>
            <?php
            $imagePath = 'image/tup.jpg';
            ?>
            <img src="<?php echo $imagePath; ?>"/>

            <h1>Goals</h1>

            <p>The College of Science prepares students to become Fully integrated individuals, <br> scientifically literate and
            technically competent to assume dynamic and responsible <br> leadership for the country's scientific and
            technological development in the improvement <br> of man's well-being and the quality of the environment.
            </p>

            <h1>Objectives</h1>

            <p>To attain the vision, mission and goals of the University, the College aims to accomplish the following
            objectives:</p>

            <li><p>Sustain the role of the College as TUP's premiere mover in science and mathematics via keeping pace
            with the University in moving onwards as a model of excellence in engineering and technology
            education.<p></li>
            <li><p>Engage actively in the University's efforts to acquire, generate and develop sufficient and state-of-the-
            art physical resources and facilities for instruction and research in science and mathematics.<p></li>
            <li><p>Develop curricular programs in science and mathematics which are relevant and responsive to the needs
            of the present times.<p></li>
            <li><p>Evaluate existing curricular programs based on their cost-effectiveness, relevance, responsiveness, and
            global competitiveness.<p></li>
            <li><p> Focus staff development programs on the pursuit of higher level of knowledge and skills in science and
            mathematics to enhance outputs in the areas of instruction, research, extension, and production.<p></li>
            <li><p> Provide for more active and productive involvement of faculty in the areas of research, extension, and
            production with focus on strengthening the major role of science and mathematics along
            multidisciplinary dimensions and areas.<p></li>
            <li><p> Promote strong linkages and networking within the various units, sectors, and campuses of the
            University as well as with related organizations, institutions and agencies both public and private.<p></li>

            
        </section>
        <footer>
            <p>&copy; <?php echo date("2023"); ?> All rights reserved.</p>
        </footer>
    </body>
</html>
