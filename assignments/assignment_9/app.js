const course = "CPS276";

const students = [
  { name: "Ava Chen", email: "  Ava.Chen@WCCNet.edu ", score: 94 },
  { name: "Ben Ortiz", email: "BEN.ORTIZ@wccnet.edu", score: 81 },
  { name: "Cara Singh", email: "  cara.singh@WCCNet.EDU", score: 73 },
  { name: "Drew Patel", email: " drew.patel@wccnet.edu ", score: 66 },
  { name: "Elena Brooks", email: "ELENA.BROOKS@WCCNet.edu", score: 88 }
];

function cleanEmail(rawEmail) {
  return rawEmail.trim().toLowerCase();
}

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

function statusLabel(score) {
  if (score >= 70) {
    return "pass";
  } else {
    return "fail";
  }
}

function classAverage(list) {
  let total = 0;

  for (const student of list) {
    total += student.score;
  }

  return total / list.length;
}

function passingNames(list) {
  return list
    .filter((student) => student.score >= 70)
    .map((student) => student.name)
    .join(", ");
}

function printReport(list) {
  console.log(`=== ${course} Gradebook ===`);
  console.log("");

  list.forEach((student) => {
    console.log(`${student.name} | ${cleanEmail(student.email)} | ${student.score} | ${letterGrade(student.score)} | ${statusLabel(student.score)}`);
  });

  console.log("");

  console.log(`Class average: ${classAverage(list).toFixed(1)}`);
  console.log(`Passing students: ${passingNames(list)}`);

  const passed = list.filter((student) => student.score >= 70).length;
  const failed = list.filter((student) => student.score < 70).length;

  console.log(`Passed: ${passed} | Failed: ${failed}`);
}

printReport(students);
