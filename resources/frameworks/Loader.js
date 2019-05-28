// JavaScript Document
window.addEventListener('DOMContentLoaded', function() {
				new QueryLoader2(document.querySelector("body"), {
					barColor: "#efefef",
					backgroundColor: "#111",
					percentage: true,
					barHeight: 1,
					minimumTime: 200,
					fadeOutTime: 1000
				});
			});
			$(document).ready(function () {
				$("body").queryLoader2();
			});