const course = "CPS276";

const students = [
  { name: "Ava Chen", email: "  Ava.Chen@WCCNet.edu ", score: 94 },
  { name: "Ben Ortiz", email: "BEN.ORTIZ@wccnet.edu", score: 81 },
  { name: "Cara Singh", email: "  cara.singh@WCCNet.EDU", score: 73 },
  { name: "Drew Patel", email: " drew.patel@wccnet.edu ", score: 66 },
  { name: "Elena Brooks", email: "ELENA.BROOKS@WCCNet.edu", score: 88 }
];

// Select page elements
const studentForm = document.querySelector("#studentForm");
const nameInput = document.querySelector("#nameInput");
const emailInput = document.querySelector("#emailInput");
const scoreInput = document.querySelector("#scoreInput");
const formError = document.querySelector("#formError");

const filterSelect = document.querySelector("#filterSelect");
const studentTableBody = document.querySelector("#studentTableBody");

const averageDisplay = document.querySelector("#averageDisplay");
const passedDisplay = document.querySelector("#passedDisplay");
const failedDisplay = document.querySelector("#failedDisplay");
const jsonPreview = document.querySelector("#jsonPreview");

// Clean email
function cleanEmail(rawEmail) {
  return rawEmail.trim().toLowerCase();
}

// Returns a letter grade.
function letterGrade(score) {
  if (score >= 90) {
    return "A";
  } else if (score >= 80) {
    return "B";
  } else if (score >= 70) {
    return "C";
  } else {
    return "F";
  }
}

// Returns pass or fail.
function statusLabel(score) {
  if (score >= 70) {
    return "pass";
  } else {
    return "fail";
  }
}

// Calculate class average
function classAverage(list) {
  if (list.length === 0) {
    return 0;
  }

  let total = 0;

  for (const student of list) {
    total += student.score;
  }

  return total / list.length;
}

// Filter students
function getFilteredStudents(list, filterValue) {
  if (filterValue === "pass") {
    return list.filter((student) => student.score >= 70);
  }

  if (filterValue === "fail") {
    return list.filter((student) => student.score < 70);
  }

  return list;
}

function makeBadge(text, badgeClass) {
  const span = document.createElement("span");

  span.classList.add("badge", badgeClass);
  span.textContent = text;

  return span;
}

// Adds a student row.
function addStudentRow(student) {
  const tr = document.createElement("tr");

  const nameCell = document.createElement("td");
  nameCell.textContent = student.name;

  const emailCell = document.createElement("td");
  emailCell.textContent = cleanEmail(student.email);

  const scoreCell = document.createElement("td");
  scoreCell.textContent = student.score;

  const gradeCell = document.createElement("td");
  const grade = letterGrade(student.score);

  let gradeClass = "text-bg-danger";

  if (grade === "A") {
    gradeClass = "text-bg-success";
  } else if (grade === "B") {
    gradeClass = "text-bg-primary";
  } else if (grade === "C") {
    gradeClass = "text-bg-warning";
  }

  gradeCell.append(makeBadge(grade, gradeClass));

  const statusCell = document.createElement("td");
  const status = statusLabel(student.score);

  let statusClass = "text-bg-danger";

  if (status === "pass") {
    statusClass = "text-bg-success";
  }

  statusCell.append(makeBadge(status, statusClass));

  tr.append(
    nameCell,
    emailCell,
    scoreCell,
    gradeCell,
    statusCell
  );

  studentTableBody.append(tr);
}

function updateSummary(list) {
  const average = classAverage(list);

  const passed = list.filter(
    (student) => student.score >= 70
  ).length;

  const failed = list.filter(
    (student) => student.score < 70
  ).length;

  averageDisplay.textContent = average.toFixed(1);
  passedDisplay.textContent = passed;
  failedDisplay.textContent = failed;
}

// Updates JSON.
function updateJson(list) {
  jsonPreview.textContent = JSON.stringify(list, null, 2);
}

function renderGradebook() {
  const filtered = getFilteredStudents(
    students,
    filterSelect.value
  );

  studentTableBody.textContent = "";

  filtered.forEach((student) => {
    addStudentRow(student);
  });

  updateSummary(students);
  updateJson(students);
}

studentForm.addEventListener("submit", (event) => {
  event.preventDefault();

  formError.textContent = "";

  const name = nameInput.value.trim();
  const email = emailInput.value.trim();
  const score = Number(scoreInput.value);

  if (name === "") {
    formError.textContent = "Please enter a name.";
    return;
  }

  if (email === "" || !email.includes("@")) {
    formError.textContent =
      "Please enter an email that includes @";
    return;
  }

  if (
    scoreInput.value.trim() === "" ||
    !Number.isFinite(score) ||
    score < 0 ||
    score > 100
  ) {
    formError.textContent =
      "Please enter a score from 0 to 100.";
    return;
  }

  students.push({
    name: name,
    email: cleanEmail(email),
    score: score
  });

  nameInput.value = "";
  emailInput.value = "";
  scoreInput.value = "";

  renderGradebook();
});

// Filter students when selection changes
filterSelect.addEventListener("change", () => {
  renderGradebook();
});

// Display original students when page loads
renderGradebook();
