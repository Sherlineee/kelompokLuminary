import java.util.ArrayList;
import java.util.List;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class AdminDAO {
    private Connection connection;

    public AdminDAO() {
        try {
            connection = DatabaseConnection.getConnection();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public List<admin> getAllAdmins() {
        List<admin> admins = new ArrayList<>();
        String sql = "SELECT * FROM admin";
        try (PreparedStatement statement = connection.prepareStatement(sql)) {
            ResultSet resultSet = statement.executeQuery();
            while (resultSet.next()) {
                admin admin = new admin();
                admin.username(resultSet.getString("Username"));
                admin.password(resultSet.getString("Password"));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return admins;
    }

    // Metode login() dan lainnya bisa tetap ada di sini
}