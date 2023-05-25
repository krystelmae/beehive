<?php

// Constants
const NUM_BEES = 5; // Number of bees in the hive
const MAX_ITERATIONS = 10; // Maximum number of iterations
const NUM_SECTION_SLOTS = 5; // Number of available section slots per course and year level

// Course and year level information
$courseYearLevels = [
    'Bachelor of Science Computer Science' => ['First Year', 'Second Year', 'Third Year', 'Fourth Year'],
    'Bachelor of Science Information System' => ['First Year', 'Second Year', 'Third Year', 'Fourth Year'],
    'Bachelor of Science Information Technology' => ['First Year', 'Second Year', 'Third Year', 'Fourth Year'],
];

// Assign sections using Beehive algorithm
$sectionAssignments = assignSectionsUsingBeehive($courseYearLevels);

// Display the section assignments
displaySectionAssignments($sectionAssignments);

/**
 * Assigns sections using the Beehive algorithm.
 *
 * @param array $courseYearLevels Array of course and year level information
 * @return array Array of section assignments
 */
function assignSectionsUsingBeehive($courseYearLevels)
{
    $sectionAssignments = [];

    foreach ($courseYearLevels as $course => $yearLevels) {
        foreach ($yearLevels as $yearLevel) {
            $numSections = getNumSections($course, $yearLevel);
            $sectionAssignments[$course][$yearLevel] = generateSectionAssignments($numSections);
        }
    }

    return $sectionAssignments;
}

/**
 * Generates section assignments using the Beehive algorithm.
 *
 * @param int $numSections Number of sections to be assigned
 * @return array Array of section assignments
 */
function generateSectionAssignments($numSections)
{
    $bees = generateInitialBees($numSections);
    $bestBee = null;

    for ($iteration = 0; $iteration < MAX_ITERATIONS; $iteration++) {
        // Send bees to explore new solutions
        foreach ($bees as &$bee) {
            $newSolution = generateNewSolution($bee['solution'], $numSections);
            $newFitness = calculateFitness($newSolution);

            if ($newFitness > $bee['fitness']) {
                $bee['solution'] = $newSolution;
                $bee['fitness'] = $newFitness;
            }

            // Check if this bee has the best fitness so far
            if (!$bestBee || $bee['fitness'] > $bestBee['fitness']) {
                $bestBee = $bee;
            }
        }

        // Update the best bee's solution to have an equal distribution of sections
        $bestBee['solution'] = equalizeSections($bestBee['solution'], $numSections);
    }

    return $bestBee['solution'];
}

/**
 * Generates the initial population of bees with random section assignments.
 *
 * @param int $numSections Number of sections to be assigned
 * @return array Array of initial bees
 */
function generateInitialBees($numSections)
{
    $bees = [];

    for ($i = 0; $i < NUM_BEES; $i++) {
        $solution = generateRandomSolution($numSections);
        $fitness = calculateFitness($solution);
        $bees[] = ['solution' => $solution, 'fitness' => $fitness];
    }

    return $bees;
}

/**
 * Generates a random solution (section assignment) for a given number of sections.
 *
 * @param int $numSections Number of sections to be assigned
 * @return array Randomly generated solution
 */
function generateRandomSolution($numSections)
{
    $solution = [];

    for ($i = 1; $i <= $numSections; $i++) {
        $solution[] = rand(1, NUM_SECTION_SLOTS);
    }

    return $solution;
}

/**
 * Generates a new solution by modifying the current solution.
 *
 * @param array $currentSolution Current solution
 * @param int $numSections Number of sections to be assigned
 * @return array New solution
 */
function generateNewSolution($currentSolution, $numSections)
{
    $newSolution = $currentSolution;

    // Randomly select a section to be modified
    $sectionIndex = rand(0, $numSections - 1);

    // Generate a new value for the selected section
    $newSolution[$sectionIndex] = rand(1, NUM_SECTION_SLOTS);

    return $newSolution;
}

/**
 * Calculates the fitness of a solution.
 * In this example, the fitness is the number of distinct section assignments.
 *
 * @param array $solution Solution to calculate the fitness for
 * @return int Fitness value
 */
function calculateFitness($solution)
{
    return count(array_unique($solution));
}

/**
 * Equalizes the section assignments to have an equal distribution of sections.
 *
 * @param array $solution Solution to be equalized
 * @param int $numSections Number of sections to be assigned
 * @return array Equalized solution
 */
function equalizeSections($solution, $numSections)
{
    $sectionCounts = array_count_values($solution);
    $maxSectionCount = max($sectionCounts);

    foreach ($sectionCounts as $section => $count) {
        if ($count < $maxSectionCount) {
            $excessSections = $maxSectionCount - $count;

            while ($excessSections > 0) {
                // Find the section with the least count
                $minCountSection = array_search(min($sectionCounts), $sectionCounts);

                // Increment the count of the section with the least count
                $solution[array_search($minCountSection, $solution)] = $section;

                $sectionCounts[$minCountSection]++;
                $excessSections--;
            }
        }
    }

    return $solution;
}

/**
 * Retrieves the number of sections for a given course and year level.
 * In this example, a static function is used. You may replace it with your own logic to retrieve the number of sections.
 *
 * @param string $course Course name
 * @param string $yearLevel Year level
 * @return int Number of sections
 */
function getNumSections($course, $yearLevel)
{
    // Replace this with your own logic to retrieve the number of sections based on the course and year level
    // For this example, we'll assume a static number of sections per course and year level
    $numSectionsPerCourseYearLevel = [
        'Bachelor of Science Computer Science' => [
            'First Year' => 3,
            'Second Year' => 2,
            'Third Year' => 4,
            'Fourth Year' => 3,
        ],
        'Bachelor of Science Information System' => [
            'First Year' => 3,
            'Second Year' => 2,
            'Third Year' => 4,
            'Fourth Year' => 3,
        ],
        'Bachelor of Science Information Technology' => [
            'First Year' => 3,
            'Second Year' => 2,
            'Third Year' => 4,
            'Fourth Year' => 3,
        ],
    ];

    return $numSectionsPerCourseYearLevel[$course][$yearLevel];
}

/**
 * Displays the section assignments.
 *
 * @param array $sectionAssignments Array of section assignments
 */
function displaySectionAssignments($sectionAssignments)
{
    echo '<h2>Section Assignments</h2>';

    foreach ($sectionAssignments as $course => $yearLevels) {
        echo '<h3>' . $course . '</h3>';

        foreach ($yearLevels as $yearLevel => $sections) {
            echo '<h4>' . $yearLevel . '</h4>';
            echo '<ul>';

            foreach ($sections as $section) {
                echo '<li>' . $section . '</li>';
            }

            echo '</ul>';
        }
    }
}
