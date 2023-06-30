var express = require("express");
var router = express.Router();
const userController = require("../controllers/users");
/* GET users listing. */
router.route("/").get(userController.users);

module.exports = router;
