import java.sql.*;

/*
jdbc_insert_item.java    // java program that is called by php that just does the insert; calls jdbc_db.java to connect and do the actual insert
jdbc_db.java // class (no main program) that has useful methods
*/

public class insertStudent {
   // The main program that inserts a restaurant
   public static void main(String[] args) throws SQLException {
      String Username = "UserName"; // Change to your own username
      String mysqlPassword = "Password"; // Change to your own mysql Password

      // Connect to the database
      jdbc_db myDB = new jdbc_db();
      myDB.connect(Username, mysqlPassword);
      myDB.initDatabase();

      // Parse input string to get restauranrestaurant Name and Address
      String Name;
      String Dept;
      String Gender;

      // Read command line arguments
      // args[0] is the first parameter
      Name = args[0];
      Dept = args[1];
      Gender = args[2];

      String q = "select IFNULL(max(STUDENT_ID), 0) as max_id from STUDENTS";
      ResultSet result = myDB.rawQuery(q);
      int student_id = 1;
      if (result.next()) // get first row of result set
         student_id += result.getInt("max_id");
      // Insert the new restaurant
      String input = "'" + student_id + "','" + Name + "','" + Dept + "','"+ Gender + "'";

      myDB.insert("STUDENTS", input); // insert new restaurant


      myDB.disConnect();
   }
}
