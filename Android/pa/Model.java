package com.example.pa;

public class Model {
        private String prenom;
        private String username;
        private String mot_de_passe;
        private String email;
        private String adresse;
        private String ville;
        private String code_postal;
        private String telephone;



        public Model(String prenom, String username, String mot_de_passe, String email, String adresse, String ville, String code_postal, String telephone) {
            this.prenom = prenom;
            this.username = username;
            this.mot_de_passe = mot_de_passe;
            this.email = email;
            this.adresse = adresse;
            this.ville= ville;
            this.code_postal= code_postal;
            this.telephone = telephone;
        }

        public String getName() {
            return prenom;
        }

        public String getUsername() {
            return username;
        }

        public String getMot_de_passe() {
            return mot_de_passe;
        }

        public String getEmail() {
            return email;
        }

        public String getAdresse() {
            return adresse;
        }

        public String getVille() {
            return ville;
        }

        public String getCode_postal() {
            return code_postal;
        }

        public void setName(String prenom) {
        this.prenom = prenom;
    }
        public String getTelephone() {
        return telephone;
    }

        public void setUsername(String username) {
        this.username = username;
    }

        public void setMot_de_passe(String mot_de_passe) {
        this.mot_de_passe = mot_de_passe;
    }

        public void setEmail(String email) {
        this.email = email;
    }

        public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

        public void setVille(String ville) {
        this.ville = ville;
    }

        public void setCode_postal(String code_postal) {
        this.code_postal = code_postal;
    }

        public void setTelephone(String telephone) {
        this.telephone = telephone;
    }




}
