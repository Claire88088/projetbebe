/**
 * Méthode pour passer de la notation rgb à la notation hexadécimale pour les couleurs
 * @param {int} r Le nombre correspondant au red en notation rgb de la couleur
 * @param {int} g Le nombre correspondant au green en notation rgb de la couleur
 * @param {int} b Le nombre correspondant au blue en notation rgb de la couleur
 * @return {string} La couleur en notation hexamdécimale
 */

function rgbToHex(r, g, b) {
    return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
}