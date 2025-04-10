package restoswing;

import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.util.ArrayList;
import javax.swing.table.DefaultTableModel;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/GUIForms/JFrame.java to edit this template
 */
/**
 *
 * @author brand
 */
public class Commande_liste extends javax.swing.JFrame {
//On créée deux nouveaux tabeleau "ARRAYLIST"

    ArrayList<Commandes> commande_liste = new ArrayList<>();
    ArrayList<Lignes> lignes = new ArrayList<>();

    /**
     * Creates new form Commande_liste
     */
    public Commande_liste() {
        //Pour initialiser l'affichage
        initComponents();
        get_data();
    }

    public void get_data() {
        //-----------------------------------------------Code pour envoyer l'URL ------------------------------------------------------
        String json = ""; // Le JSON brut
        String url
                = "http://127.0.0.1/projets/CazaFamilia/CasaFamillia/liste_commande.php";
// Créer un HttpClient
        HttpClient client = HttpClient.newHttpClient();
// Crée une requête HTTP GET
        try {
// Construit l'URL de la requête
            HttpRequest request = HttpRequest.newBuilder()
                    .uri(new URI(url))
                    .build();
// Envoie la requête et attend la réponse
            HttpResponse<String> response = client.send(request,
                    HttpResponse.BodyHandlers.ofString());
// Vérifie que la réponse est normale
            if (response.statusCode() == 200) {
                json = response.body();
            } else {
                System.err.println("Erreur : Code statut " + response.statusCode());
            }
        } catch (Exception ex) {
            System.err.println("Erreur : " + ex.getMessage());
//ex.printStackTrace();
        }
        // Afficher le JSON brut récupéré
        //System.out.println(json);
        //On met à jour L'ARRAYLIST
        commande_liste = new ArrayList<>();
        //---------------------------------------------fin de code pour envoyer l'URL--------------------------------------------------
        //---------------------------------------------Debut du parsage JSON-----------------------------------------------------------
        //On créée un nouveau JSONARRAY
        JSONArray commande_liste_json = new JSONArray(json);

        try {
            // Parcourir le tableau JSON 
            for (int i = 0; i < commande_liste_json.length(); i++) {
                //On créée un nouveau JSONOBJECT
                JSONObject commande_json = commande_liste_json.getJSONObject(i);
                // Réinitialiser la liste des lignes pour chaque commandes
                ArrayList<Lignes> lignes = new ArrayList<>();

                // Récupérer les lignes de commande
                JSONArray lignes_json = commande_json.getJSONArray("lignes");
                for (int j = 0; j < lignes_json.length(); j++) {
                    JSONObject ligne_json = lignes_json.getJSONObject(j);
                    Lignes ligne = new Lignes(
                            ligne_json.getInt("id_ligne_commande"),
                            ligne_json.getInt("id_commande"),
                            ligne_json.getInt("id_produit"),
                            ligne_json.getInt("qte"),
                            ligne_json.getString("total_ligne_ht"),
                            ligne_json.getString("libelle")
                    );
                    lignes.add(ligne);
                }

                // Créer la commande avec les lignes associées
                if (commande_json.getInt("id_etat") == 1 || commande_json.getInt("id_etat") == 0) {
                    Commandes commande = new Commandes(
                            commande_json.getInt("id_commande"),
                            commande_json.getInt("id_user"),
                            commande_json.getInt("id_etat"),
                            commande_json.getString("_date"),
                            commande_json.getString("total_commande"),
                            commande_json.getString("login"),
                            commande_json.getInt("type_conso"),
                            commande_json.getInt("total_nb_produit"),
                            lignes
                    );
                    //On ajoute dans l'arraylist commande _liste les éléments de l'objet commande de la classe Commande
                    commande_liste.add(commande);
                }

            }
        } catch (JSONException ex) {
            System.err.println("Erreur : " + ex.getMessage());
        }
        //System.out.println(commande_liste.size());

// Construire le tableau de données
        Object[][] data = new Object[commande_liste.size()][7];
        for (int i = 0; i < commande_liste.size(); i++) {
            Commandes cmd = commande_liste.get(i);
            data[i][0] = cmd.getId_commande();
            data[i][1] = cmd.getId_user();
            
            data[i][2] = cmd.getId_etat() == 1 ? "Accepter" : "En attente"; 
            data[i][3] = cmd.getDate();
            data[i][4] = cmd.getTotal_commande();
            data[i][5] = cmd.getType_conso() == 1 ? "Ᾱ emporter":"Sur place";
            data[i][6] = cmd.getTotal_nb_produit();
        }

// Définir les entêtes des colonnes
        String[] cols = {"id_commande", "id_user", "id_etat", "_date", "total_commande", "type_conso", "total_nb_produit"};

// Appliquer le modèle au JTable
        DefaultTableModel model = new DefaultTableModel(data, cols);
        table_commande.setModel(model);

    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")

    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        button1 = new java.awt.Button();
        button2 = new java.awt.Button();
        jScrollPane1 = new javax.swing.JScrollPane();
        table_commande = new javax.swing.JTable();
        jLabel1 = new javax.swing.JLabel();
        jButton1 = new javax.swing.JButton();
        jButton2 = new javax.swing.JButton();

        button1.setLabel("button1");

        button2.setLabel("button2");

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        table_commande.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null}
            },
            new String [] {
                "Title 1", "Title 2", "Title 3", "Title 4"
            }
        ));
        jScrollPane1.setViewportView(table_commande);

        jLabel1.setText("Resto swing");

        jButton1.setText("Détails");
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });

        jButton2.setText("Quitter");
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(419, 419, 419)
                        .addComponent(jLabel1))
                    .addGroup(layout.createSequentialGroup()
                        .addContainerGap()
                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 755, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(layout.createSequentialGroup()
                                .addGap(58, 58, 58)
                                .addComponent(jButton1))
                            .addGroup(layout.createSequentialGroup()
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                .addComponent(jButton2)))))
                .addContainerGap(87, Short.MAX_VALUE))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                .addGap(53, 53, 53)
                .addComponent(jLabel1)
                .addGap(66, 66, 66)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(jButton1)
                        .addGap(67, 67, 67)
                        .addComponent(jButton2))
                    .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 250, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addContainerGap(68, Short.MAX_VALUE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed
        // TODO add your handling code here:
        int row = table_commande.getSelectedRow();
        //System.out.println("row ="+row);

        // Récupére la région sélectionnée et ouvre la fenêtre JDialog des départements de la région
        if (row >= 0 && row < table_commande.getRowCount()) {
            // Récupére la région sélectionnée
            Commandes commande = commande_liste.get(row);
            //System.out.println(region);

            // Crée la fenêtre JDialog des départements en passant la région sélectionnée     
            Ligne_liste ligne_liste = new Ligne_liste(this, true, commande);

            // Ajoute un Listener quand la fenêtre "departement_liste" est fermée
            ligne_liste.addWindowListener(new WindowAdapter() {
                public void windowClosed(WindowEvent e) {
                    System.out.println("jdialog window closed"); // test
                    get_data(); // Rafraichit le JTable
                } // windowClosed()

            });

            // Affiche la fenêtre des départements
            ligne_liste.setVisible(true);
        } // if
    }//GEN-LAST:event_jButton1ActionPerformed

    private void jButton2ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton2ActionPerformed
        System.exit(0);
    }//GEN-LAST:event_jButton2ActionPerformed

    /**
     * @param args the command line arguments
     *
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel
     
    //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
    /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(Commande_liste.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(Commande_liste.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(Commande_liste.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(Commande_liste.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {

            public void run() {
                new Commande_liste().setVisible(true);
            }

        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private java.awt.Button button1;
    private java.awt.Button button2;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton2;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTable table_commande;
    // End of variables declaration//GEN-END:variables
}
